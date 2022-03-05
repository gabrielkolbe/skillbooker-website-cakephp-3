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
class AvailabilityController extends AppController
{

   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('ajax');

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

     public function edit($date) {
      
          $user_id = $this->Auth->user('id');
          $this->loadComponent('Availabilitycalendar');
        
          $explode = explode('-', $date);
  
          $month = $explode['0'];
          $year = $explode['1'];
          
          $this->set('month', $month);
          
          $calendar = $this->Availabilitycalendar->insertCalendar($user_id, $month, $year);
          $this->set('calendar', $calendar);  
          
        
    } 
    
    public function editaction($month) {


     $user_id = $this->Auth->user('id');
      if ($this->request->is('post')) { 
    
        $this->loadModel('UserAvailability');

        $insertdates = $this->request->data['selectedday'];
        if(!empty($insertdates)) {
        
          $this->UserAvailability->deleteAll(['user_id' => $user_id, 'DATE_FORMAT(event_date,"%m")' => $month]);
          foreach($insertdates as $kdate => $va){ 
          
            $Table = TableRegistry::get('UserAvailability');
            $insert = $Table->newEntity();
            
            $insert->user_id = $user_id;
            $insert->event_date = $kdate;

            if ($Table->save($insert)) {
               $saved = 1; 
            }
          }
        }
      }
        if($saved == 1){
          $this->Flash->success(__('You Availability dates has been updated.'));
        } else {
          $this->Flash->error(__('You Availability was NOT updated.'));
        }
        
        $this->redirect(['plugin'=>false, 'controller'=>'portfolio', 'action' => 'index']);      

    }        


}