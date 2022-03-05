<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ApplicationsController extends AppController
{

   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('frontside');
        $this->set('setstate', 'jobs');

    }
    
    public function isAuthorized($user)
    {
    
      if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to access this page.'));
          return $this->redirect(['controller' => 'users', 'action' => 'login']);
      } else {
          return true;
      }
         return parent::isAuthorized($user);
    }
   
    
  public function index(){
  
    if(is_null($this->Auth->user('id'))){
          $this->Flash->error(__('Please login to access this page.'));
          return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
    } else {
         $user_id = $this->Auth->user('id');
    } 

      $this->loadModel('Jobs');
      $applications = $this->Jobs->find('all',[
          'fields'=>['Application.id', 'Application.created', 'Jobs.id', 'Jobs.title',  'Jobs.display_salary', 'Jobs.city', 'Jobs.display_jobtype'],
          'conditions'=>['Application.user_id = '.$user_id.''],
          'join' => [
                        [
                          'table' => 'jobapplications',
                          'alias' => 'Application',
                          'type' => 'LEFT',
                          'conditions' => [
                           'Application.job_id = Jobs.id'
                          ]
                        ]
          ],
          'sort' => ['Application.id' => 'DESC'] 
          ]);
                        
        $this->set('applications', $applications); 
        }
   
   
     public function lists($jobid = null){
  
    if(is_null($this->Auth->user('id'))){
          $this->Flash->error(__('Please login to access this page.'));
          return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
    } else {
         $user_id = $this->Auth->user('id');
    } 
      
      if(!$jobid == null) { $condition = 'Application.job_id = '.$jobid.'';  $this->set('jobid', $jobid);   } else { $condition = '1 = 1'; }
      
  
      $this->loadModel('Jobs');
      $applications = $this->Jobs->find('all',[
          'fields'=>['Application.id', 'Application.created', 'Jobs.id', 'Jobs.title', 'Users.slug', 'Users.name', 'Users.email'],
          'conditions'=>['Application.recruiter_id = '.$user_id.' AND '.$condition.'' ],
          'join' => [
                        [
                          'table' => 'jobapplications',
                          'alias' => 'Application',
                          'type' => 'LEFT',
                          'conditions' => [
                           'Application.job_id = Jobs.id'
                          ]
                        ],
                        [
                          'table' => 'users',
                          'alias' => 'Users',
                          'type' => 'LEFT',
                          'conditions' => [
                           'Application.user_id = Users.id'
                          ]
                        ]
          ],
          'sort' => ['Application.id' => 'DESC'] 
          ]);
                        
        $this->set('applications', $applications);
        
        }


     
        
    public function deleteapplication($id)
    {
    
        if(is_null($this->Auth->user('id'))){
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
             $user_id = $this->Auth->user('id');
        } 
    
        $this->request->allowMethod(['post', 'delete']);
        
        $this->loadModel('Jobapplications');
        $application = $this->Jobapplications->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $application = $application->first();
        $job_id = $application->job_id;
        
        if ($this->Jobapplications->delete($application)) {
        
        
        $this->loadModel('Jobs');
        $job = $this->Jobs->find('all', ['conditions'=> ['Jobs.id'=>$job_id]]);
        $job = $job->first();

        $applicationcount =  $job->applicationcount - 1;
        
        $UpdateTable = TableRegistry::get('Jobs');
        $update = $UpdateTable->get($job_id);
        $update->applicationcount = $applicationcount;
        $UpdateTable->save($update);
        
        
        $this->Flash->success(__('The job application has been deleted.'));
        } else {
        $this->Flash->error(__('The job application could not be deleted. Please, try again.'));
        }

          return $this->redirect(['plugin' => null, 'controller' => 'applications', 'action' => 'index']);
    }
    
  public function applymodal($jobid){
      
      if(is_null($this->Auth->user('id'))){
          $this->Flash->error(__('Please login to access this page.'));
          return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
      } else {
         $user_id = $this->Auth->user('id');
      }
      
      $this->viewBuilder()->layout('ajax');
      
      $this->loadModel('Jobs');
      $job = $this->Jobs->find('all',['fields' => ['id', 'title'], 'conditions'=> ['Jobs.id'=>$jobid]]);
      $job = $job->first();
      $this->set('job', $job);                                                                                                                
    
    }
    
    
    public function applyaction(){
      
      if(is_null($this->Auth->user('id'))){
          $this->Flash->error(__('Please login to access this page.'));
          return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
      } else {
         $user_id = $this->Auth->user('id');
      } 
      
      if ($this->request->is(['patch', 'post', 'put'])) {
          
      $job_id = $this->request->data['id'];
      
      $this->loadModel('Jobapplications');
      $application = $this->Jobapplications->find('all',['fields' => ['id'], 'conditions'=> ['Jobapplications.job_id'=>$job_id, 'Jobapplications.user_id'=>$user_id]]);
      $application = $application->first();

      
      if(!empty($application->id)) {
      
          $this->Flash->success(__('You have already applied for this job.'));
          return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'index']);
      
      } else {
      
        $this->loadModel('Jobs');
        $job = $this->Jobs->find('all', ['conditions'=> ['Jobs.id'=>$job_id]]);
        $job = $job->first();
                
        $applyTable = TableRegistry::get('Jobapplications');
        $apply = $applyTable->newEntity();
        $apply->job_id = $job->id;
        $apply->user_id = $user_id;
        $apply->recruiter_id = $job->user_id;
        $apply->applicationstatus_id = 1;
        $apply->created = date('Y-m-d');
        $apply->modified = date('Y-m-d');
        $applyTable->save($apply);
        
        $applicationcount =  $job->applicationcount + 1;
        $UpdateTable = TableRegistry::get('Jobs');
        $update = $UpdateTable->get($job_id);
        $update->applicationcount = $applicationcount;
        $UpdateTable->save($update);
        
     /*   
          
						$keys = array();
						$keys[] = $job->recruiter_name;
						$keys[] = $this->Auth->user('firstname').' '. $this->Auth->user('lastname');
						$keys[] = "<a href='".DEFAULT_SITE_URL."/jobboard/jobs/view/".$job->id."'>".$job->title."</a>";
            $keys[] = "<a href='".DEFAULT_SITE_URL."/applications/applications'>Candidate Applications</a>";
          
            $sendvalues = array();
            $sendvalues['to'] = $job->recruiter_email;
            $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 2;
      
        if(SENDMAIL == 1) {      
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues);  
       }    
         */     
          $this->Flash->success(__('Thank you for your application it will be passed on to the right person.'));
          return $this->redirect(['plugin' => null, 'controller' => 'applications', 'action' => 'index']);
          
         
      }                                                                                                                   
    }    
}


    

}