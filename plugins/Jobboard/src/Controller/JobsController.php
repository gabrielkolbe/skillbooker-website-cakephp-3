<?php
namespace Jobboard\Controller;

use Jobboard\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;   

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
        $this->viewBuilder()->layout('front');
        $this->Auth->allow();
        $this->set('setstate', 'jobs');

        $this->set('pagetitle', 'Skillbooker.com - Job Market');
        $this->set('taglist', 'Job Market');
        $this->set('pagedescription', 'Skillbooker.com - Job Market'); 
        
    }
    
    public function isAuthorized($user)
    {
        if (isset($user['role_id']) && $user['role_id'] == '1') {
            return true;             
        }
        
         return parent::isAuthorized($user);
    }


	public function index() {
  
  $session = $this->request->session();
  $skill_list = $session->read('selected_job_skills');
  
    if(($session->check('jobtype')) == true){
      $jobtype = $session->read('jobtype');
      $this->set('jobtype', $jobtype);
    } else {
      $this->set('jobtype', 1);
    }
  
    if(($session->check('industry')) == true){
      $industry = $session->read('industry');
      $this->set('industry', $industry);
    }
    
    if(($session->check('country')) == true){
      $country = $session->read('country');
      $this->set('country', $country);
    } 
        
    if ($this->request->is('post')) {
    // search post to index
    
        if($this->request->data['sendfrom'] == 'skillsearch'){
          //debug($this->request->data);
          //die;
          if(!empty($this->request->data['skill'])) {
            $skill_list = $this->request->data['skill'];
          }
        if(!empty($this->request->data['jobtype_id'])) {
            $jobtype = $this->request->data['jobtype_id'];
        } else {
           $jobtype = 1;
        }
          
          $this->indexaction($skill_list, $jobtype);                    
        }
         
    } else { 
          if(empty($skill_list)) { $skill_list = NULL; }
          $this->indexaction($skill_list);
    } 
    
    $this->loadModel('JobskillDistincts');
    $jobskillsdistinct = $this->JobskillDistincts->find('list', ['keyField' => 'skill_id', 'valueField' => 'skill_name']);
		$this->set('jobskillsdistinct',$jobskillsdistinct);
    
    $this->loadModel('Jobtypes');
		$jobtypeslist = $this->Jobtypes->find('list', ['keyField' => 'id', 'valueField' => 'name']);
		$this->set('jobtypeslist',$jobtypeslist); 
  
	}
  
  
public function indexaction($skill_list, $jobtype=null) {

      $session = $this->request->session();
       if(($session->check('industry_id')) == true){
          $industry_id = $session->read('industry_id');
        } else {
          $industry_id = 20;
        }
        
        if(($session->check('country_id')) == true){
          $country_id = $session->read('country_id');
        } else {
           $country_id = 226;
        } 

        if(!$skill_list == null) {        
                
          $skillids = '';
          foreach($skill_list as $k => $v) {
              $skillids .= $v.',';
          }
          
          $skillids = rtrim($skillids,',');
          
          
        if(!empty($skillids)){
            
          $this->loadModel('Jobskills');
          $jobids = $this->Jobskills->find('all',['fields' => ['job_id'], 'conditions'=>['Jobskills.skill_id IN ('.$skillids.')', 'Jobskills.industry_id' => $industry_id]]);
      
          $jobidslist = '';
          foreach($jobids as $job) {
            $jobidslist .= $job->job_id.',';
          }
          $jobidslist = rtrim($jobidslist,','); 
          
          $jobidcondition = 'Jobs.id IN ('.$jobidslist.')';
          
        } 
        
        $showskill_list = array_flip ($skill_list);        
        $session->write('selected_job_skills',$skill_list);
        $this->set('selected_job_skills', $skill_list);
        $session->write('showskill_list',$showskill_list);        
        $this->set('showskill_list', $showskill_list); 
        
      } else {      
          $jobidcondition = 'Jobs.id > 0';
          // get all
      }
    
  
      if(!is_null($this->Auth->user('id'))){
        $user_id = $this->Auth->user('id');
        $conditions = 'Application.job_id = Jobs.id AND Application.user_id = '.$user_id.'';
      } else {
        $user_id = -1;
        $conditions = 'Application.job_id = 0';
      }                
      $this->set('user_id', $user_id);
           
      if( ($jobtype == null) || ( $jobtype == 1) ) {
        $jobtype_condition = '';
      } else {
        $jobtype_condition = 'Jobs.jobtype_id = '.$jobtype;
      }
      
      $session->write('jobtype',$jobtype);
      $this->set('jobtype', $jobtype);
      
      //$sixmonthago = date("Y-m-d", strtotime("-6 months"));
      //'Jobs.created > ' => $sixmonthago,
      
          $result = $this->Jobs->find('all',[
          'fields'=>['Application.user_id', 'Jobs.id', 'Jobs.slug','Jobs.title',  'Jobs.display_salary', 'Jobs.city', 'Jobs.display_state', 'Jobs.display_jobtype', 'Jobs.display_date', 'Jobs.description', 'Jobs.created'],
          'conditions'=>[$jobidcondition, 'Jobs.country_id' => $country_id,  $jobtype_condition],
          'join' => [
                        [
                          'table' => 'jobapplications',
                          'alias' => 'Application',
                          'type' => 'LEFT',
                          'conditions' => [
                           $conditions 
                          ]
                        ]
          ],
          'order' => ['Jobs.id' => 'DESC'],
          'limit' => 20                   
          ]);
          
          
          $session->write('jobtype',$jobtype);
          $this->set('jobtype', $jobtype);
  
              
        $this->set('result', $result);
          
        
}


public function search($slug=null) {

    $session = $this->request->session();
    
    if($slug == null) { } else {
    $this->loadModel('Skills');
    $skills =  $this->Skills->find('all',['conditions'=>['Skills.slug' => $slug]]);
    $skills = $skills->first();
    $showskill_list[$skills->id] = $skills->name;
    $session->write('showskill_list',$showskill_list);
    }
    
    if(($session->check('industry_id')) == true){
    $industry_id = $session->read('industry_id');
    } else {
    $industry_id = 20;
    //default fall back
    }
    
    $this->loadModel('JobskillDistincts');
    $jobskillsdistinct = $this->JobskillDistincts->find('list', 
    ['keyField' => 'skill_id', 'valueField' => 'skill_name', 'conditions'=> ['JobskillDistincts.industry_id'=>$industry_id]]);
		$jobskillsdistinct = $jobskillsdistinct->toArray();
    $this->set('jobskillsdistinct',$jobskillsdistinct);
    
    
    if(($session->check('selected_job_skills')) == true){
    $selected_job_skills = $session->read('selected_job_skills');
    $this->set('selected_job_skills', $selected_job_skills);
    }
                                                                                
    if(($session->check('showskill_list')) == true){
    $showskill_list = $session->read('showskill_list');
    $this->set('showskill_list', $showskill_list);
    }
    
    if(($session->check('industry')) == true){
    $industry = $session->read('industry');
    $this->set('industry', $industry);
    }

    if(($session->check('country')) == true){
    $country = $session->read('country');
    $this->set('country', $country);
    }
    
   $pagedescription = 'Search for local jobs';
   $this->set('pagedescription', $pagedescription);
   $taglist = 'jobs, it jobs, php jobs, laravel jobs, cakephp jobs, freelance jobs, contract jobs';
   $this->set('taglist', $taglist);
}



    public function view($slug){
           
      $job = $this->Jobs->find('all',['conditions'=> ['Jobs.slug'=>$slug]]);
      $job = $job->first();
      $job_id = $job->id;
      $this->set('job', $job);
          
      $this->loadModel('Jobskills');
      $jobskills = $this->Jobskills->find('all',['fields' => ['skill_id', 'skill_name', 'slug'], 'conditions'=>['Jobskills.job_id' => $job_id]]);
      $this->set('jobskills', $jobskills);
      
      $skilllist = '';
      foreach($jobskills as $skill) {
        $skilllist .= $skill->skill_id.',';
      }
      $skilllist = rtrim($skilllist,',');
        
        if(!empty($skilllist)) {
        $suggested = $this->Jobskills->find('all',[
          'fields'=>['Jobs.id', 'Jobs.slug', 'Jobs.title', 'Jobs.city', 'Jobs.display_jobtype'],
          'conditions'=>['Jobskills.skill_id IN ('.$skilllist.') AND Jobs.id  <> '.$job_id],
          'join' => [
                        [
                          'table' => 'jobs',
                          'alias' => 'Jobs',
                          'type' => 'LEFT',
                          'conditions' => [
                           'Jobskills.job_id = Jobs.id'
                          ]
                        ]
          ],
          'sort' => ['Jobs.id' => 'DESC'],
          'limit' => 20                   
          ]);
        $this->set('suggested', $suggested);
        }  else {
        $this->set('suggested', '');
        }
        
      $session = $this->request->session();
      
      if(($session->check('jobtype')) == true){
        $jobtype = $session->read('jobtype');
        $this->set('jobtype', $jobtype);
      } else {
       $this->set('jobtype', 1);
      }
      
    if(($session->check('industry')) == true){
      $industry = $session->read('industry');
      $this->set('industry', $industry);
    }
      
    if(($session->check('country')) == true){
      $country = $session->read('country');
      $this->set('country', $country);
    }
    
    if(($session->check('showskill_list')) == true){
    $showskill_list = $session->read('showskill_list');
    $this->set('showskill_list', $showskill_list);
    } else {
    $this->set('showskill_list', '');
    }
                                                                                                                  
    $this->loadModel('JobskillDistincts');
    $jobskillsdistinct = $this->JobskillDistincts->find('list', ['keyField' => 'skill_id', 'valueField' => 'skill_name']);
		$this->set('jobskillsdistinct',$jobskillsdistinct);
    
    $this->loadModel('Jobtypes');
		$jobtypeslist = $this->Jobtypes->find('list', ['keyField' => 'id', 'valueField' => 'name']);
		$this->set('jobtypeslist',$jobtypeslist);
   
    $taglist = '';
    foreach($jobskillsdistinct as $key => $value) {
     $taglist .= $value.',';
    } 
  
   $this->set('pagetitle', $job->title);
   $this->set('pagedescription', $job->title);
   $this->set('taglist', $taglist); 
   
    }

    
    public function expired()
    {   
      $this->loadModel('Expiredjobs');
 
        $jobs = $this->paginate($this->Expiredjobs);

        $this->set(compact('jobs'));
        $this->set('_serialize', ['jobs']);
      
    }
      
      public function expiredjob($slug = null)
    {   
      $this->loadModel('Expiredjobs');
      if(!empty($slug)) {
      
        $job = $this->Expiredjobs->find('all',
              ['conditions' => ['Expiredjobs.slug' => $slug] 
        ]);
        $job = $job->first();
        
        $this->set('job', $job);
      
      }
    }
    

    
    public function changeindustrymodal(){
      
      $this->viewBuilder()->layout('ajax');
      $this->loadModel('IndustryDistincts');
      $industries = $this->IndustryDistincts->find('all',
              ['order' => ['IndustryDistincts.name ASC'] 
      ]);
      $this->set('industries', $industries);                                                                                                                
    
    }
    
    public function changeindustrymodalaction(){
      
      $this->autoRender = false;
      $this->request->allowMethod(['post']);
          
        if(!empty($this->request->data['industries'])) {
          
          $this->loadModel('IndustryDistincts');
          $industries = $this->IndustryDistincts->find('all',
              ['conditions' => ['IndustryDistincts.id' => $this->request->data['industries']] 
          ]);
          
          $industry = $industries->first();

          $session = $this->request->session();
          $session->write('industry',$industry->name);
          $session->write('industry_id',$industry->industry_id);

          $this->Flash->success(__('You have changed the default Industry. If you login this will be your default.'));
          
      } else {
          $this->Flash->error(__('Industry was not selected or changed.'));
      }                                                                                                                
        return $this->redirect($this->referer());
    }
    
    
    public function changecountrymodal(){
      
      $this->viewBuilder()->layout('ajax');
      $this->loadModel('CountryDistincts');
      $countries = $this->CountryDistincts->find('all',
              ['order' => ['CountryDistincts.name ASC'] 
      ]);
      $this->set('countries', $countries);                                                                                                                
    
    }

        public function changecountrymodalaction(){
      
      $this->autoRender = false;
      $this->request->allowMethod(['post']);
          
        if(!empty($this->request->data['country_id'])) {
          
          $this->loadModel('CountryDistincts');
          $countries = $this->CountryDistincts->find('all',
              ['conditions' => ['CountryDistincts.id' => $this->request->data['country_id']] 
          ]);
          
          $country = $countries->first();

          $session = $this->request->session();
          $session->write('country',$country->name);
          $session->write('country_id',$country->country_id);

          $this->Flash->success(__('You have changed the default Country. If you login this will be your default.'));
          
      } else {
          $this->Flash->error(__('Country was not selected or changed.'));
      }                                                                                                                
        return $this->redirect($this->referer());
    }
    
  
      public function jobs()
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->viewBuilder()->layout('frontside');
        
        $credit = 0;
        
        $this->loadModel('UserCredit');
        $credit = $this->UserCredit->find('all',['conditions'=>['UserCredit.user_id'=>$user_id]]);
        $credit = $credit->first();
        
        if(!empty($credit->id)) { $credit = $credit->jobs; }
      
        $this->paginate = [
                'conditions' => ['Jobs.user_id' => $user_id ],
                'order' => ['Jobs.id' => 'DESC']
        ];
          

        $jobs = $this->paginate($this->Jobs);

        $this->set(compact('jobs', 'credit'));
        $this->set('_serialize', ['jobs']);
    }
    
    
    
    public function add()
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->viewBuilder()->layout('frontside');
                
        $this->loadModel('UserCredit');
        $credit = $this->UserCredit->find('all',['conditions'=>['UserCredit.user_id'=>$user_id]]);
        $credit = $credit->first(); 
        
        if(!empty($credit)){
        
        if( $credit->jobs < 1) {
          //buy credit
          $this->Flash->success(__('Please buy some credit.'));
          return $this->redirect(['plugin' => null, 'controller' => 'salesoptions', 'action' => 'jobs']);
        }
        
        } else {
        //buy credit
        $this->Flash->success(__('Please buy some credit.'));
        return $this->redirect(['plugin' => null, 'controller' => 'salesoptions', 'action' => 'jobs']);
        }   
        
        
        $job = $this->Jobs->newEntity();
        
        if ($this->request->is('post')) {
        
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
      
     
     if(!empty($this->request->data['salaryoption'])) {
         if($this->request->data['salaryoption'] == 1 ) {

          if(!empty($this->request->data['currency_id'])) {
          
          $this->loadModel('Currencies');
          $currencies = $this->Currencies
            ->find()
            ->where(['id' => $this->request->data['currency_id']])
            ->first();
     
          $currency = $currencies->html_entity;

          } else {
          $currency = '';
          }
          
         if(!empty($this->request->data['min_salary'])) {
         $minsalary = $this->request->data['min_salary'].' - ';
         } else {
         $minsalary = '';
         }
         
          if(!empty($this->request->data['max_salary'])) {
         $maxsalary = $this->request->data['max_salary'];
         } else {
         $maxsalary = '';
         }
           
        if(!empty($this->request->data['paymentinterval_id'])) {
         
              $this->loadModel('Paymentintervals');
              $interval = $this->Paymentintervals
                ->find()
                ->where(['id' => $this->request->data['paymentinterval_id']])
                ->first();
            
            $payment = ' '.$interval->name;
          
                
         } else {
         $payment= '';
         }
                
         $job->display_salary = $currency.$minsalary.$maxsalary.$payment;
          
    }
    
         if($this->request->data['salaryoption'] == 2 ) {
         
            if ( !empty($this->request->data['salarydesc_id']) ) {
        
              $this->loadModel('Salarydescs');
              $salary = $this->Salarydescs->find('all',['conditions'=>['Salarydescs.id'=>$this->request->data['salarydesc_id']]]);
              $salary = $salary->first();
              
              $job->display_salary = $salary->name;
                    
            }
         
         }
    } else {
      $this->Flash->error(__('Please select a salary display option.'));
      return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'add']);
    }   

        
    if(!empty($this->request->data['dateoption'])) {
      if($this->request->data['dateoption'] == 1 ) {
    
       if ( !empty($this->request->data['startdate']) ) {
          $startdate = $this->request->data['startdate'].' - ';
       } else { $startdate = ''; }
    
        if ( !empty($this->request->data['enddate']) ) {
          $enddate = $this->request->data['enddate'];
       } else { $enddate = ''; }
       
       $job->display_date = $startdate.$enddate;
    
      }
      
      if($this->request->data['dateoption'] == 2 ) {
        if(!empty($this->request->data['datedesc_id'])) { 
          
          $this->loadModel('Datedescs');
          $date = $this->Datedescs
            ->find()
            ->where(['id' => $this->request->data['datedesc_id']])
            ->first();
          
          $job->display_date = $date->name;
        
        }      
      }      
    } else {
      $this->Flash->error(__('Please select a salary display option.'));
      return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'add']);
    }
    
      $this->loadComponent('slugcreator');
      $job->slug = $this->slugcreator->userslug($job->title);
      
      $job->user_id = $user_id;
      $job->recruiter_email = $this->Auth->user('email');
      $job->recruiter_name = $this->Auth->user('name');
      $job->title = ucfirst(strtolower($this->request->data['title']));
      $job->city = ucfirst(strtolower($this->request->data['city']));

      $jobslug =  $job->slug;
      $jobtitle = $job->title;
      $titlelink =  '<a href="www.skillbooker.com/jobboard/jobs/view/'.$jobslug.'">'.$jobtitle.'</a>';
      // debug($job);
     //  die; 
     
     $job->description = $this->cleanhtml($job->description);                                                       
     
       if (  (empty($job->display_date)) || (empty($job->display_salary)) || (empty($job->display_jobtype)) || (empty($job->display_country)) ) {
          $this->Flash->error(__('Some of your selections are empty.'));
          return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'add']);
       }
      
        if ($this->Jobs->save($job)) {
            $this->scancontentforskills($job->description, $job->id);
            
            $Table = TableRegistry::get('UserCredit');
            $updatecredit = $Table->get($credit->id);
            
            $updatecredit->jobs = $credit->jobs - 1;
            $Table->save($updatecredit);
            
            $keys = array();
            $keys[] = $this->Auth->user('name');
            $keys[] = $titlelink;
            
            $sendvalues = array();
            $sendvalues['to'] = $this->Auth->user('email');
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 7;

      if(SENDMAIL == 1) {
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues); 
      }
            
            $this->Flash->success(__('The job has been saved.'));
            return $this->redirect(['action' => 'skills', $job->id]);
        }

            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        
        $jobtypes = $this->Jobs->Jobtypes->find('list');
        $this->loadModel('Currencies');
        $currencies = $this->Currencies->find('list');
        
        $paymentintervals = $this->Jobs->Paymentintervals->find('list');
        $salarydescs = $this->Jobs->Salarydescs->find('list');
        $industries = $this->Jobs->Industries->find('list');
        $countries = $this->Jobs->Countries->find('list');
            
        $datedescs = $this->Jobs->Datedescs->find('list');
                
        $this->set(compact('job', 'jobtypes', 'recruitmentprogress', 'currencies', 'paymentintervals', 'salarydescs',  'industries', 'countries', 'states', 'datedescs', 'jobsources', 'credit'));
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
        
        $this->viewBuilder()->layout('frontside');
                  
      $job = $this->Jobs->find('all',['conditions'=>['Jobs.id'=>$id, 'Jobs.user_id'=>$user_id]]);
      $job = $job->first();
      
        if(empty($job->id)){
            $this->Flash->error(__('Sorry, this job does not belong to you.'));
            return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'index']);
        }
        
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
      
        if(!empty($this->request->data['salaryoption'])) {
        if($this->request->data['salaryoption'] == 1 ) {
         
        if(!empty($this->request->data['currency_id'])) {
          $this->loadModel('Currencies');
          $currencies = $this->Currencies
            ->find()
            ->where(['id' => $this->request->data['currency_id']])
            ->first();
     
          $currency = $currencies->html_entity;
        } else {
        $currency = '';
        }

         if(!empty($this->request->data['min_salary'])) {
         $minsalary = $this->request->data['min_salary'].' - ';
         } else {
         $minsalary = '';
         }
         
          if(!empty($this->request->data['max_salary'])) {
         $maxsalary = $this->request->data['max_salary'];
         } else {
         $maxsalary = '';
         }
         
        if(!empty($this->request->data['paymentinterval_id'])) {
         
              $this->loadModel('Paymentintervals');
              $interval = $this->Paymentintervals
                ->find()
                ->where(['id' => $this->request->data['paymentinterval_id']])
                ->first();
            
            $payment = ' '.$interval->name;
                
         } else {
         $payment= '';
         }
                
         $job->display_salary = $currency.$minsalary.$maxsalary.$payment;
          
    }
    
         if($this->request->data['salaryoption'] == 2 ) {
         
            if ( !empty($this->request->data['salarydesc_id']) ) {
        
              $this->loadModel('Salarydescs');
              $salary = $this->Salarydescs
                ->find()
                ->where(['id' => $this->request->data['salarydesc_id']])
                ->first();
              
              $job->display_salary = $salary->name;
                    
            }
         
         }
    } else {
      $this->Flash->error(__('Please select a salary display option.'));
      return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'add']);
    }   

        
    if(!empty($this->request->data['dateoption'])) {
      if($this->request->data['dateoption'] == 1 ) {
    
       if ( !empty($this->request->data['startdate']) ) {
          $startdate = $this->request->data['startdate'].' - ';
       } else { $startdate = ''; }
    
        if ( !empty($this->request->data['enddate']) ) {
          $enddate = $this->request->data['enddate'];
       } else { $enddate = ''; }
       
       $job->display_date = $startdate.$enddate;
    
      }
      
      if($this->request->data['dateoption'] == 2 ) {
        if(empty($this->request->data['datedesc_id'])) { 
          
          $this->loadModel('Datedescs');
          $date = $this->Datedescs
            ->find()
            ->where(['id' => $this->request->data['datedesc_id']])
            ->first();
          
          $job->display_date = $date->name;
        
        }      
      }      
    } else {
      $this->Flash->error(__('Please select a salary display option.'));
      return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'add']);
    }
    
      $this->loadComponent('slugcreator');
      $job->slug = $this->slugcreator->userslug($job->title);
    
      $job->title = ucfirst(strtolower($this->request->data['title']));
      $job->city = ucfirst(strtolower($this->request->data['city']));
      
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
                  
        if(is_null($this->Auth->user('id'))){
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'loginmodal']);
        } else {
             $user_id = $this->Auth->user('id');
        } 


        $this->loadModel('Jobs');
        $job = $this->Jobs->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $job = $job->first();
        
        if(empty($job->id)){
            $this->Flash->error(__('Sorry, this job does not belong to you.'));
            return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'index']);
        }
        
        
        if ($this->Jobs->delete($job)) {
        
        //$this->deleteAll(['is_spam' => true]);
        
        
            $this->Flash->success(__('The job has been deleted.'));
        } else {
            $this->Flash->error(__('The job could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'jobs']);
    }
    
    
  public function skills($id = null)
    {
    
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->viewBuilder()->layout('frontside');
        
      if(empty($id)) {
          $this->Flash->error(__('Sorry there seems to be an error.'));
          return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'jobs']);
      }
        
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
           return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'jobs']);
        }
        
        
      $job = $this->Jobs->find('all',['conditions'=>['Jobs.id'=>$id, 'Jobs.user_id'=>$user_id]]);
      $job = $job->first();
        
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
                        $addskill->created =	date('Y-m-d');        
          
                        $Table_us->save($addskill);
                        
											}
										}
                   
								 }      

    }
    
function cleanhtml($text){

$text = str_replace("<p>&nbsp;</p>", "", $text); 
$find =  array("justify", "Verdana, sans-serif", " style=", "font-size", "font-family", "mso-ansi-language", "mso-bidi-font-size", "EN-US", "<div>" , "</div>" , "<div " , "</div " ,  "class=" , "<!--" , "<xml>" , "<w:", "-->", "'", "<?", "<table", "<Table", "<TABLE", "<ta", "<TA", "MsoHeader", "0cm" , "0pt" , "margin", "text-indent", "MsoNormal", "0in", "tab-stops", "Arial", "mso-bidi", " pt ", "mso-list", "Times New Roman", "mso-spacerun", "lang=", "x-small", "id=", "line-height: ", "align=", "text-align:", "<h1", "</h1>", "\r" , "\n");
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