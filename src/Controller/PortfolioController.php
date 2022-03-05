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
class PortfolioController extends AppController
{

   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('frontside');
        $this->set('setstate', 'portfolio');
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
    

  public function index() {
      
      if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to access this page.'));
          return $this->redirect(['controller' => 'users', 'action' => 'login']);
      }
    
      $user_id = $this->Auth->user('id');
      
        $this->loadModel('Users');  
        $user = $this->Users->find('all',['conditions'=>['Users.id'=>$user_id]]);
        $user = $user->first();           
        $this->set('user', $user);
        
        $this->loadModel('Candidates');  
        $candidate = $this->Candidates->find('all',[
        'conditions'=>['Candidates.user_id'=>$user_id],
        ]);
        $candidate = $candidate->first();
         
        $this->loadComponent('Availabilitycalendar');
        
        $now = new \DateTime('now');
        $currentmonth = $now->format('m');
        $year = $now->format('Y');
        
        $calendar1 = $this->Availabilitycalendar->editCalendar('yes', $user_id,$currentmonth,$year);    
        
        if($currentmonth == 12) { $month = 0; $year = $year +1; } else { $month = $currentmonth; }
        
        $nextmonth= $month + 1;
        $nextnextmonth= $nextmonth + 2;
        
      $calendar2 = $this->Availabilitycalendar->editCalendar('yes',$user_id,$nextmonth,$year);
        
      $calendar3 = $this->Availabilitycalendar->editCalendar('yes',$user_id,$nextnextmonth,$year); 
        
      $countries = $this->Users->Countries->find('list');
        
      $skills = $this->Users->UserSkills->find('all',['conditions'=>['UserSkills.user_id'=>$user_id],'order'=>'UserSkills.slug asc']);
        
      $this->set(compact('user','candidate', 'countries', 'calendar1', 'calendar2', 'calendar3', 'skills')); 
                                                                                                                              
    }
    
  
      public function editcandidate()
    {

       $this->viewBuilder()->layout('ajax');
        
        $user_id = $this->Auth->user('id');            
        
        $this->loadModel('Candidates');  
        $candidate = $this->Candidates->find('all',[
        'conditions'=>['Candidates.user_id'=>$user_id],
        ]);
        $candidate = $candidate->first();
        
        $this->loadModel('Jobtypes');
        $jobtypes = $this->Jobtypes->find('list', ['limit' => 200]);
        
        $this->loadModel('Contactmethods');
        $contactmethods = $this->Contactmethods->find('list', ['limit' => 200]);
        
        $this->set(compact('jobtypes', 'candidate', 'contactmethods'));
    }
    
    
        public function editcandidateaction() {
          
        if(is_null($this->Auth->user('id'))){
              $this->Flash->success(__('Please login to access this page.'));
              return $this->redirect(['controller' => 'users', 'action' => 'loginmodal']);
        } else {
             $user_id = $this->Auth->user('id');
        } 
        
        $this->autoRender = false;
        
          if ($this->request->is(['patch', 'post', 'put'])) {
          
              
            $this->loadModel('Candidates');
            $candidate = $this->Candidates->find('all', [ 
              'conditions' => ['user_id' => $user_id]
            ]);
            $candidate = $candidate->first();

            $candidate = $this->Candidates->patchEntity($candidate, $this->request->data);
            
            $candidate->available_from = $this->request->data['available_from']['year'].'-'.$this->request->data['available_from']['month'].'-'.$this->request->data['available_from']['day'];

            
            if(!empty($this->request->data['jobtype_id'])) { 
            $this->loadModel('Jobtypes');
            $jobtypes = $this->Jobtypes->find('all',['conditions'=>['Jobtypes.id'=>$this->request->data['jobtype_id']]]);
            $jobtypes = $jobtypes->first();
            $candidate->display_jobtype = $jobtypes['name'];
            }
            
            
            if(!empty($this->request->data['jobtype_id'])) {             
            $this->loadModel('Contactmethods');
            $contactmethods = $this->Contactmethods->find('all',['conditions'=>['Contactmethods.id'=>$this->request->data['contactmethod_id']]]);
            $contactmethods = $contactmethods->first();
            $candidate->display_contactmethod = $contactmethods['name'];
            }
            
            if ($this->Candidates->save($candidate)) {
                $this->Flash->success(__('Your candidate details has been saved.'));
                return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            } else {
                $this->Flash->error(__('Your candidate details could not be saved. Please, try again.'));
            }
        }
    
    }
    
      public function editsummary()
    {

       $this->viewBuilder()->layout('ajax');
        
        $user_id = $this->Auth->user('id');            
        
        $this->loadModel('Candidates');  
        $candidate = $this->Candidates->find('all',[
        'conditions'=>['Candidates.user_id'=>$user_id],
        ]);
        $candidate = $candidate->first();
        
        $this->set(compact('candidate'));
    }
    
      public function editsummaryaction() {
          
        if(is_null($this->Auth->user('id'))){
              $this->Flash->success(__('Please login to access this page.'));
              return $this->redirect(['controller' => 'users', 'action' => 'loginmodal']);
        } else {
             $user_id = $this->Auth->user('id');
        } 
        
        $this->autoRender = false;
        
          if ($this->request->is(['patch', 'post', 'put'])) {
          
              
            $this->loadModel('Candidates');
            $candidate = $this->Candidates->find('all', [ 
              'conditions' => ['user_id' => $user_id]
            ]);
            $candidate = $candidate->first();

            $candidate = $this->Candidates->patchEntity($candidate, $this->request->data);

            if ($this->Candidates->save($candidate)) {
                $this->Flash->success(__('Your summary has been saved.'));
                return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            } else {
                $this->Flash->error(__('Your summary could not be saved. Please, try again.'));
            }
        }
    
    }

}