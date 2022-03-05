<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Jobs Controller
 *
 * @property \Jobs\Model\Table\JobsTable $Jobs
 */
class JobsController extends AppController
{

         public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'jobs');  
        
    }
    
    public function isAuthorized($user)
    {
    
        if (isset($user['role_id']) && $user['role_id'] == '1') {
            return true;             
        } else {
          $this->Flash->error(__('Sorry, you dont have access to this page'));
          return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        }
        
         return parent::isAuthorized($user);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {      
        $this->paginate = [
                'order' => ['Jobs.id' => 'DESC']
        ];
    
        $jobs = $this->paginate($this->Jobs);

        $this->set(compact('jobs'));
        $this->set('_serialize', ['jobs']);
    }

    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => ['Jobtypes', 'Companies', 'Industries', 'Subindustries', 'Jobskills']
        ]);

        $this->set('job', $job);
        $this->set('_serialize', ['job']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $job = $this->Jobs->newEntity();
        
        if ($this->request->is('post')) {
        
        //dd($this->request->data);                
        
        $job = $this->Jobs->patchEntity($job, $this->request->data);
        
        $ref = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz',2)),0,5);
        $job->reference = $ref;

      if(!empty($this->request->data['country_id'])) { 
          $this->loadModel('Countries');
          $country = $this->Countries
            ->find()
            ->where(['id' => $this->request->data['country_id']])
            ->first();
        
        $job->display_country = $country->name;
        
       }
       
      if(!empty($this->request->data['jobtype_id'])) {   
        $this->loadModel('Jobtypes');
          $jobtypes = $this->Jobtypes
            ->find()
            ->where(['id' => $this->request->data['jobtype_id']])        
            ->first();
     
        $job->display_jobtype = $jobtypes->name;
      } 
      
      //dd($this->request->data) ;
      
      if(!empty($this->request->data['uselist'])) {   
        $this->loadModel('Recruiters');
        $recruiter = $this->Recruiters->find('all', ['conditions' => ['Recruiters.id'=> $this->request->data['recruiter_id']]]);
        $recruiter = $recruiter->first();
     
        $job->recruiter_name = $recruiter->firstname.' '.$recruiter->lastname;
        $job->recruiter_email = $recruiter->email;        
      
      } else {
      
        $this->loadModel('Recruiters');
        $recruiter = $this->Recruiters->find('all', ['conditions' => ['Recruiters.email'=> $this->request->data['recruiter_email']]]);
        $recruiter = $recruiter->first();

        if(empty($recruiter->id)) {
        
          $name = trim(ucwords($this->request->data['recruiter_name']));
          $explode = explode(' ', $name);
          //dd($explode);
                         
          $Table = TableRegistry::get('Recruiters');
          $insert = $Table->newEntity();
          
          $insert->user_role_id = 2;
          $insert->firstname = $explode['0'];
          $insert->lastname = $explode['1'];
          $insert->email = $this->request->data['recruiter_email'];
          $insert->created = date('Y-m-d');
          $insert->modified = date('Y-m-d');                                        
        
          $Table->save($insert);
        
        }
        
        $job->recruiter_name = ucwords($this->request->data['recruiter_name']);
        $job->recruiter_email = ucwords($this->request->data['recruiter_email']); 
 
      
      } 
      
      $job->user_id = $user_id;
      // debug($job);
     //  die;                                                        
     
       if (  (empty($job->display_date)) || (empty($job->display_salary)) || (empty($job->display_jobtype)) || (empty($job->display_country)) ) {
          $this->Flash->error(__('Some of your selections are empty.'));
          return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'add']);
       }
       
      $this->loadComponent('slugcreator');
      $job->slug = $this->slugcreator->userslug($job->title);
       
        $job->created = date('Y-m-d');
        $job->modified = date('Y-m-d');
        
      $job->description = $this->cleanhtml($job->description); 
      
        if ($this->Jobs->save($job)) {
            $this->scancontentforskills($job->description, $job->id);
            
            $this->Flash->success(__('The job has been saved.'));
            return $this->redirect(['action' => 'skills', $job->id]);
        }

            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        
        $jobtypes = $this->Jobs->Jobtypes->find('list'); 
                
        $this->loadModel('Recruiters');
        $recruiters = $this->Recruiters->find('all', [
        'fields' => ['Recruiters.id', 'Recruiters.firstname', 'Recruiters.lastname', 'Recruiters.email'], 
        'conditions' => ['Recruiters.user_role_id' => 2 ], 
        'order' => 'Recruiters.email ASC'
        ] );
        
        $recruiterslist = array();
        foreach($recruiters as $recruiter){
          $recruiterslist[$recruiter->id] = $recruiter->email.' '.$recruiter->firstname.' '.$recruiter->lastname;
        }
        
        $industries = $this->Jobs->Industries->find('list');
        $countries = $this->Jobs->Countries->find('list');
      
                
        $this->set(compact('job', 'jobtypes', 'recruitmentprogress',  'industries', 'countries', 'recruiterslist'));
        $this->set('_serialize', ['job']);
    }
    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
          
      $job = $this->Jobs->find('all',['conditions'=>['Jobs.id'=>$id, 'Jobs.user_id'=>$user_id]]);
      $job = $job->first();
      
      
        if ($this->request->is(['patch', 'post', 'put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->data);
      

      if(!empty($this->request->data['country_id'])) { 
          $this->loadModel('Countries');
          $country = $this->Countries
            ->find()
            ->where(['id' => $this->request->data['country_id']])
            ->first();
        
        $job->display_country = $country->name;
        
       }
       
      if(!empty($this->request->data['jobtype_id'])) {   
        $this->loadModel('Jobtypes');
          $jobtypes = $this->Jobtypes
            ->find()
            ->where(['id' => $this->request->data['jobtype_id']])
            ->first();
     
        $job->display_jobtype = $jobtypes->name;
      } 
                   
            $this->loadComponent('slugcreator');
            $job->slug = $this->slugcreator->userslug($job->title);       
            $job->modified = date('Y-m-d');
            $job->description = $this->cleanhtml($job->description); 
            
            if ($this->Jobs->save($job)) {
            
              $this->scancontentforskills($job->description, $job->id);
            
              $this->Flash->success(__('The job has been edited.'));
              return $this->redirect(['action' => 'skills', $job->id]);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        
        $this->loadModel('Currencies');
        $currencies = $this->Currencies->find('list');
        $jobtypes = $this->Jobs->Jobtypes->find('list');

        $paymentintervals = $this->Jobs->Paymentintervals->find('list');
        $salarydescs = $this->Jobs->Salarydescs->find('list');
        $industries = $this->Jobs->Industries->find('list');
        $countries = $this->Jobs->Countries->find('list');
            
        $datedescs = $this->Jobs->Datedescs->find('list');
                
        $this->set(compact('job', 'jobtypes', 'recruitmentprogress', 'currencies', 'paymentintervals', 'salarydescs',  'industries', 'countries', 'states', 'datedescs'));

        $this->set('_serialize', ['job']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $job = $this->Jobs->get($id);
        if ($this->Jobs->delete($job)) {
            $this->Flash->success(__('The job has been deleted.'));
        } else {
            $this->Flash->error(__('The job could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    public function skills($id = null)
    {
        if ($this->request->is('post')) {
        
        $this->loadModel('Jobskills');       
        $this->Jobskills->deleteAll(['job_id' => $id]);
        
        $this->loadModel('Skills');

        foreach($this->request->data['skill_id'] as $key => $val){
   
             if(($val <> '') && ($val <> 0) ) {
               
                  $sk = $this->Skills->find('all', ['conditions' => ['id' => $val]])->first();
           
          				$JobskillsTable = TableRegistry::get('Jobskills');
                  $jobskills = $JobskillsTable->newEntity();
                  
     							$jobskills->job_id = $id;
    							$jobskills->skill_id = $sk->id;
                  $jobskills->skill_name		=	$sk->name;
    					    $jobskills->slug		=	$sk->slug;
                  $jobskills->industry_id	=	$sk->industry_id;
                  $jobskills->created	=	date('Y-m-d');
                  
                  $JobskillsTable->save($jobskills);
                       
              }
          }
          
           $this->Flash->success(__('The Skills for this job has been updated.'));
           return $this->redirect(['action' => 'index']);
        }
        
        
        $job = $this->Jobs->get($id);
        
          $this->loadModel('Skills');
          $skills = $this->Skills
            ->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where(['industry_id' => $job->industry_id])
            ->toArray();
            
          $this->loadModel('Industries');
          $industries = $this->Industries
            ->find()
            ->where(['id' =>  $job->industry_id])
            ->first();
            
          $this->loadModel('Jobskills');
          $jobskills = $this->Jobskills
            ->find('list', ['keyField' => 'skill_id', 'valueField' => 'skill_name'])
            ->where(['job_id' => $job->id])
            ->toArray();
          
        
        $this->set(compact('job', 'skills', 'industries', 'jobskills'));
        $this->set('_serialize', ['jobs']);
    }
    
           public function scancontentforskills($content, $jobid)
    {   

          $this->loadComponent('Filereader');                  
            
            $Tableskills = TableRegistry::get('Skills');
              $skills = $Tableskills->find('all');	
              
         
								foreach($skills as $skill) {                         			
            										                  
                    $tempobject = $this->Filereader->searchwordlowercase($content,$skill->slug);

										if(!empty($tempobject)) { 
                    
                      $Table_us = TableRegistry::get('Jobskills');
											$skill_entry = $Table_us->find('all',['conditions'=>['job_id' => $jobid, 'slug'=>$skill->slug]]);
                      $entrycount = $skill_entry->count();
                        
                      if($entrycount < 1) {
                      
                        $addskill = $Table_us->newEntity();
                        
                        $addskill->job_id		=	$jobid;
          							$addskill->skill_id			=	$skill->id;
                        $addskill->skill_name	=	$skill->name;
          							$addskill->slug	=	$skill->slug;
                        $addskill->industry_id =	$skill->industry_id;
                        $addskill->created = date('Y-m-d');         
          
                        $Table_us->save($addskill);
                        
											}
										}
                   
								 }      

    }
    
 
  public function totwitter($id) {
  
    $this->loadModel('Jobs'); 
    $job = $this->Jobs->find('all',['conditions'=>['id'=>$id]]);
    $job = $job->first();
  
    $twitterkeywordlist = '';

    $this->loadModel('Jobskills'); 
    $skills = $this->Jobskills->find('all',['conditions'=>['job_id'=>$job->id]]);
   
    foreach($skills as $key => $val){              
          $twitterkeywordlist .= '#'.trim($val->slug).' ';
    }
    
  
    $this->loadComponent('Codebird');
    $codebird = $this->Codebird->setConsumerKey(TWITTERCONSUMERKEY, TWITTERCONSUMERKEYSECRET);
    $bird = $this->Codebird->getInstance();
    $bird->setToken(TWITTERACCESSTOKEN, TWITTERACCESSTOKENSECRET);
  
    $params = array('status' => $job->title.' http://www.skillbooker.com/jobboard/jobs/view/'.$job->slug.'  '.$twitterkeywordlist);
    $reply = $bird->statuses_update($params); 
    

    if(!empty($reply->id)) {
    
      $Table = TableRegistry::get('Jobs');
      $update = $Table->get($job->id); 
      $update->twittercount = $job->twittercount + 1;
      $Table->save($update);
    
      $this->Flash->success(__('This job has been added to Twitter.'));
    
    } else {
      $this->Flash->error(__('Twitter adding error.'));
    }
    
      return $this->redirect(['action' => 'index']);

  }

function cleanhtml($text){

$text = str_replace("<p>&nbsp;</p>", "", $text); 
$find =  array("justify", "Verdana, sans-serif", " style=", "font-size", "font-family", "mso-ansi-language", "mso-bidi-font-size", "EN-US", "<div>" , "</div>" , "<div " , "</div " ,  "class=" , "<!--" , "<xml>" , "<w:", "-->", "'", "<?", "<table", "<Table", "<TABLE", "<ta", "<TA", "MsoHeader", "0cm" , "0pt" , "margin", "text-indent", "MsoNormal", "0in", "tab-stops", "Arial", "mso-bidi", " pt ", "mso-list", "Times New Roman", "mso-spacerun", "lang=", "x-small", "id=", "line-height: ", "align=", "text-align:", "<h1", "</h1>", "\r" , "\n", "</span>");
$text = trim($text);
$text = str_replace($find, ' ', $text);
$text = str_replace('"', '&#39;', $text);
$text = str_replace("'", "&#39;", $text); 
$text = stripslashes($text);
//$text = strip_tags($text);
//$text = htmlspecialchars($var,ENT_QUOTES);

  
  return $text;

} 
}
            