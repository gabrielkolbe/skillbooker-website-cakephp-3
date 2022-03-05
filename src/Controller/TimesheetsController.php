<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Timesheets Controller
 *
 * @property \App\Model\Table\TimesheetsTable $Timesheets
 */
class TimesheetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
          $this->Auth->allow();
        
        $this->viewBuilder()->layout('frontside');
        $this->set('setstate', 'tools');
        
        $this->set('pagetitle', 'Skillbooker.com - Timesheets');
        $this->set('taglist', 'Timesheets');
        $this->set('pagedescription', 'Skillbooker.com -  Timesheets'); 

    }
    
    public function isAuthorized($user)
    {       
         return parent::isAuthorized($user);
    }  
     

        public function index()
    {
    
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->paginate = [
            'contain' => ['Users', 'TimesheetProcesses'],
            'conditions'=>['Timesheets.user_id = '.$user_id],
            'order' => ['Timesheets.id' => 'DESC'] 
        ];
        $timesheets = $this->paginate($this->Timesheets);

        $this->set(compact('timesheets'));
        $this->set('_serialize', ['timesheets']);
    }

    /**
     * View method
     *
     * @param string|null $id Timesheet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $employee =  $this->Auth->user('name');
        $this->set('employee', $employee);
        
        $timesheet = $this->Timesheets->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $timesheet = $timesheet->first();      
        
        if(empty($timesheet->id)){
            $this->Flash->error(__('Sorry, this timesheet does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'timesheets', 'action' => 'index']);
        }
        
        $currentmonth = $timesheet->currentmonth->i18nFormat('MM');
        $currentyear = $timesheet->currentmonth->i18nFormat('YYYY');
        
        $this->set('currentmonth', $currentmonth);                                
        $this->set('currentyear', $currentyear);
        
        $this->loadComponent('Availabilitycalendar');
        $calendar = $this->Availabilitycalendar->editTimesheet('no', $timesheet->slug, 'example', $currentmonth, $currentyear);
        $this->set('calendar', $calendar);
        
        $this->loadModel('TimesheetUsers');
        $agent = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 3, 'TimesheetUsers.user_id' => $user_id]]);
        $agent = $agent->first();
        $agent = $agent->name; 
        
        $this->set('agent', $agent);                       

       $employer = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 4, 'TimesheetUsers.user_id' => $user_id]]);
        $employer = $employer->first();
        $employer = $employer->name;
        
        $this->set('employer', $employer);                
                
        $this->set('timesheet', $timesheet);
        $this->set('_serialize', ['timesheet']);
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
        
        
        $this->loadModel('TimesheetUsers');
        $agents = $this->TimesheetUsers->find('list', ['conditions' => ['TimesheetUsers.role_id' => 3], 'limit' => 200]);
        $agents = $agents->toArray();
        $employers = $this->TimesheetUsers->find('list', ['conditions' => ['TimesheetUsers.role_id' => 4], 'limit' => 200]);
        $employers = $employers->toArray();
        
        $this->set('employers', $employers); 
        $this->set('agents', $agents);
        
        if(!empty($agents) ){ } else {
          $this->Flash->error(__('Please add some agents and employers.'));
           return $this->redirect(['controller' => 'timesheet-users', 'action' => 'index']);
        }
        
        if(!empty($employers) ){ } else {
           $this->Flash->error(__('Please add some agents and employers.'));
           return $this->redirect(['controller' => 'timesheet-users', 'action' => 'index']);
        }  
        
        $timesheet = $this->Timesheets->newEntity();
        if ($this->request->is('post')) {
            $timesheet = $this->Timesheets->patchEntity($timesheet, $this->request->data);
      
          
            $currentmonth = $timesheet->currentmonth->i18nFormat('MM');
            $currentyear = $timesheet->currentmonth->i18nFormat('YYYY');
            
            $timesheet->name =  $currentmonth .'-'.$currentyear.'-'.$timesheet->name;
            
            if(!empty( $timesheet->selectedday)) {
             $dates = $timesheet->selectedday;
              $days = '';
              foreach ($dates as $key => $value) {
                  $explode = explode("-", $key);
                  $days .= $explode[2].',';
              }
            }
            $days = rtrim($days, ',');
            $timesheet->days = $days;
            
            $this->loadComponent('slugcreator');
            $timesheet->slug = $this->slugcreator->no_dash_slug($timesheet->name);
            
            $timesheet->status = 1;
            $timesheet->timesheet_process_id = 1;
            $timesheet->user_id = $user_id;
          
            
            if ($this->Timesheets->save($timesheet)) {
                $this->Flash->success(__('The timesheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timesheet could not be saved. Please, try again.'));
        }
        

          
        $this->set(compact('timesheet'));
        $this->set('_serialize', ['timesheet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Timesheet id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $timesheet = $this->Timesheets->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $timesheet = $timesheet->first();      
        
        if(empty($timesheet->id)){
            $this->Flash->error(__('Sorry, this timesheet does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'timesheets', 'action' => 'index']);
        }
        
        
        $currentmonth = $timesheet->currentmonth->i18nFormat('MM');
        $currentyear = $timesheet->currentmonth->i18nFormat('YYYY');
        
 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timesheet = $this->Timesheets->patchEntity($timesheet, $this->request->data);
            if ($this->Timesheets->save($timesheet)) {
                $this->Flash->success(__('The timesheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timesheet could not be saved. Please, try again.'));
        }
        
        $this->loadComponent('Availabilitycalendar');
        $calendar = $this->Availabilitycalendar->editTimesheet('yes', $timesheet->slug, 'editdays', $currentmonth, $currentyear);
        $this->set('calendar', $calendar);
        
        $this->loadModel('TimesheetUsers');
        $agents = $this->TimesheetUsers->find('list', ['conditions' => ['TimesheetUsers.role_id' => 3], 'limit' => 200]);
        $employers = $this->TimesheetUsers->find('list', ['conditions' => ['TimesheetUsers.role_id' => 4], 'limit' => 200]);
        
        $this->set('employers', $employers); 
        $this->set('agents', $agents); 
        
        $timesheetProcesses = $this->Timesheets->TimesheetProcesses->find('list', ['limit' => 200]);
        $this->set(compact('timesheet', 'users', 'timesheetProcesses'));
        $this->set('_serialize', ['timesheet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Timesheet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($slug = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $timesheet = $this->Timesheets->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $timesheet = $timesheet->first();      
        
        if(empty($timesheet->id)){
            $this->Flash->error(__('Sorry, this timesheet does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'timesheets', 'action' => 'index']);
        }
        
        $this->request->allowMethod(['post', 'delete']);

        if ($this->Timesheets->delete($timesheet)) {
            $this->Flash->success(__('The timesheet has been deleted.'));
        } else {
            $this->Flash->error(__('The timesheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
      public function getcalendar()
    {

        if(!empty($_POST['theyear'])) { 
        
        $theyear = $_POST['theyear'];
        $themonth = $_POST['themonth'];  
    
        //$this->log($themonth, 'debug');
        
        $this->viewBuilder()->layout('ajax');
        
        
        $this->loadComponent('Availabilitycalendar');
        $calendar = $this->Availabilitycalendar->insertCalendar(1, $themonth, $theyear);
        $this->set('calendar', $calendar); 
            

      }
    }
    
         public function editdays($date) {
      
          $this->viewBuilder()->layout('ajax');
          
          $user_id = $this->Auth->user('id');
          $this->loadComponent('Availabilitycalendar');
        
          $explode = explode('-', $date);
  
          $month = $explode['0'];
          $year = $explode['1'];
          $slug = $explode['2'];
          
          $this->set('slug', $slug);
          
          $calendar = $this->Availabilitycalendar->insertCalendar($user_id, $month, $year);
          $this->set('calendar', $calendar);  

    }
      
      public function editaction($slug) {


      $user_id = $this->Auth->user('id');
      if ($this->request->is('post')) { 
    

        $insertdates = $this->request->data['selectedday'];
        if(!empty($insertdates)) {

          $days = '';
          foreach($insertdates as $key => $value){ 
            
            $explode = explode("-", $key);
            $days .= $explode[2].',';

          }
          $days = rtrim($days, ',');
        }
        
        $timesheets = $this->Timesheets->find('all',['conditions'=>['Timesheets.user_id'=>$user_id, 'slug' => $slug]]);
        $timesheets = $timesheets->first();
        

        $timesheets->days = $days;


        if($this->Timesheets->save($timesheets)){
          $this->Flash->success(__('You Timesheet dates has been updated.'));
        } else {
          $this->Flash->error(__('You Timesheet was NOT updated.'));
        }
        
        }
        
        $this->redirect(['plugin'=>false, 'controller'=>'timesheets', 'action' => 'index']);      

    } 
    
    
    public function confirmtimesheet($date) {
      
          $this->viewBuilder()->layout('ajax');
          
          $user_id = $this->Auth->user('id');
          $this->loadComponent('Availabilitycalendar');
        
          $explode = explode('-', $date);
  
          $month = $explode['0'];
          $year = $explode['1'];
          $slug = $explode['2'];
          
          $this->set('slug', $slug);
          
          $calendar = $this->Availabilitycalendar->insertCalendar($user_id, $month, $year);
          $this->set('calendar', $calendar);  

    } 
    
        public function example($date) {
      
          $this->viewBuilder()->layout('ajax');
          
          $user_id = $this->Auth->user('id');
          $this->loadComponent('Availabilitycalendar');
        
          $explode = explode('-', $date);
  
          $month = $explode['0'];
          $year = $explode['1'];
          $slug = $explode['2'];
          
          $this->set('slug', $slug);
          
          $calendar = $this->Availabilitycalendar->insertCalendar($user_id, $month, $year);
          $this->set('calendar', $calendar);  

    }
    
      public function timesheetcycle() {
      
          $this->viewBuilder()->layout('ajax');

    } 
    
    public function toempployer($slug=null) {
    
      if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $employee = $this->Auth->user('name');    
        
        $timesheet = $this->Timesheets->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $timesheet = $timesheet->first();      
        
        if(empty($timesheet->id)){
            $this->Flash->error(__('Sorry, this timesheet does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'timesheets', 'action' => 'index']);
        }
        
        $this->loadModel('TimesheetUsers');
        $employer = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 4, 'TimesheetUsers.user_id' => $user_id]]);
        $employer = $employer->first();
        $employername = $employer->name;
        $employeremail = $employer->email;
        
        $this->loadComponent('Encrypt');                  
        $string = $this->Encrypt->encode($slug);  

        if(SENDMAIL == 1) {
              
            $keys = array();
            $keys[] = $employername;
            $keys[] = $string;
            $keys[] = $employee;
            
            $sendvalues = array();
            $sendvalues['to'] = $employeremail;
            $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 24;
      
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues); 
            
            
            $Table = TableRegistry::get('Timesheets');
            $update = $Table->get($timesheet->id); 

            $update->timesheet_process_id = 2;
            $Table->save($update); 
        }
            
            $this->Flash->success(__('The timesheet has been sent to the employer for approval.'));
            $this->redirect(['plugin'=>false, 'controller'=>'timesheets', 'action' => 'index']);

    } 
    
        public function approve($string = null)
    {
        $this->viewBuilder()->layout('front');
        
        $this->loadComponent('Encrypt');                  
        $slug = $this->Encrypt->decode($string);
        
        $this->set('string', $string);
        
        $timesheet = $this->Timesheets->find('all', [ 
          'conditions' => ['slug' => $slug, 'timesheet_process_id' => 2]
        ]);
        $timesheet = $timesheet->first();      
        
        if(empty($timesheet->id)){
            $this->Flash->error(__('Sorry, this timesheet does not exist.'));
            return $this->redirect('/');
        }
        
        $currentmonth = $timesheet->currentmonth->i18nFormat('MM');
        $currentyear = $timesheet->currentmonth->i18nFormat('YYYY');
        
        $this->set('currentmonth', $currentmonth);                                
        $this->set('currentyear', $currentyear);
        
        $this->loadComponent('Availabilitycalendar');
        $calendar = $this->Availabilitycalendar->editTimesheet('no', $timesheet->slug, 'example', $currentmonth, $currentyear);
        $this->set('calendar', $calendar);
        
        $this->loadModel('Users');
        $employee = $this->Users->find('all', ['conditions' => ['Users.id' => $timesheet->user_id]]);
        $employee = $employee->first();
        $employee = $employee->name; 
        
        $this->set('employee', $employee);
        
        $this->loadModel('TimesheetUsers');
        $agent = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 3, 'TimesheetUsers.user_id' => $timesheet->user_id]]);
        $agent = $agent->first();
        $agent = $agent->name; 
        
        $this->set('agent', $agent);                       

        $employer = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 4, 'TimesheetUsers.user_id' => $timesheet->user_id]]);
        $employer = $employer->first();
        $employer = $employer->name;
        
        $this->set('employer', $employer);                
                
        $this->set('timesheet', $timesheet);
        $this->set('_serialize', ['timesheet']);
    } 
    
    
      public function approveaction() {


      if ($this->request->is('post')) { 
    

        $string = $this->request->data['string'];
        if(!empty($string)) {

          $this->loadComponent('Encrypt');
          $slug = $this->Encrypt->decode($string);
          
          $timesheet = $this->Timesheets->find('all', [ 
            'conditions' => ['slug' => $slug]
          ]);
          $timesheet = $timesheet->first();      
          
          if(empty($timesheet->id)){
              $this->Flash->error(__('Sorry, this timesheet does not exist.'));
              return $this->redirect('/');
          }
          
          $confirm = $this->request->data['confirm'];
          if($confirm == 1) {
          
          $Table = TableRegistry::get('Timesheets');
          $update = $Table->get($timesheet->id); 

          $update->timesheet_process_id = 3;
          $Table->save($update);

            
              if(SENDMAIL == 1) {
              
                  $this->loadModel('Users');
                  $employee = $this->Users->find('all', ['conditions' => ['Users.id' => $timesheet->user_id]]);
                  $employee = $employee->first();
                  
                  
                  $this->loadModel('TimesheetUsers');
                  $agent = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 3, 'TimesheetUsers.user_id' => $timesheet->user_id]]);
                  $agent = $agent->first();
                     
          
                  $employer = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 4, 'TimesheetUsers.user_id' => $timesheet->user_id]]);
                  $employer = $employer->first();

                    
                  $keys = array();
                  $keys[] = $agent->name;
                  $keys[] = $timesheet->name;
                  $keys[] = $string;
                  $keys[] = $employee->name;
                  $keys[] = $employer->name;
                  //	AGENT,TIMESHEET,LINK,EMPLOYEE,EMPLOYER
                  
                  
                  $sendvalues = array();
                  $sendvalues['to'] = $agent->email;
                  $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
                  $sendvalues['keys'] = $keys;
                  $sendvalues['templateid'] = 25;
            
                  $this->loadComponent('Emailc');                  
                  $emailc = $this->Emailc->send_email($sendvalues); 
                  
             }
              
            $this->Flash->success(__('The timesheet has been approved, relevant parties will be informed.'));
            return $this->redirect('/');
            
           } else {
            $this->Flash->success(__('The timesheet has not been approved yet.'));
            $this->redirect(['plugin'=>false, 'controller'=>'timesheets', 'action' => 'approve', $string]);
          }

        }
        
        }
          

    }  
    
    
        public function forview($string = null)
    {
        $this->viewBuilder()->layout('front');
        
        $this->loadComponent('Encrypt');                  
        $slug = $this->Encrypt->decode($string);
        
   
        $timesheet = $this->Timesheets->find('all', [ 
          'conditions' => ['slug' => $slug, 'timesheet_process_id' => 3]
        ]);
        $timesheet = $timesheet->first();      
        
        if(empty($timesheet->id)){
            $this->Flash->error(__('Sorry, this timesheet does not exist.'));
            return $this->redirect('/');
        }
        
        $currentmonth = $timesheet->currentmonth->i18nFormat('MM');
        $currentyear = $timesheet->currentmonth->i18nFormat('YYYY');
        
        $this->set('currentmonth', $currentmonth);                                
        $this->set('currentyear', $currentyear);
        
        $this->loadComponent('Availabilitycalendar');
        $calendar = $this->Availabilitycalendar->editTimesheet('no', $timesheet->slug, 'example', $currentmonth, $currentyear);
        $this->set('calendar', $calendar);
        
        $this->loadModel('Users');
        $employee = $this->Users->find('all', ['conditions' => ['Users.id' => $timesheet->user_id]]);
        $employee = $employee->first();
        $employee = $employee->name; 
        
        $this->set('employee', $employee);
        
        $this->loadModel('TimesheetUsers');
        $agent = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 3, 'TimesheetUsers.user_id' => $timesheet->user_id]]);
        $agent = $agent->first();
        $agent = $agent->name; 
        
        $this->set('agent', $agent);                       

        $employer = $this->TimesheetUsers->find('all', ['conditions' => ['TimesheetUsers.role_id' => 4, 'TimesheetUsers.user_id' => $timesheet->user_id]]);
        $employer = $employer->first();
        $employer = $employer->name;
        
        $this->set('employer', $employer);                
                
        $this->set('timesheet', $timesheet);
        $this->set('_serialize', ['timesheet']);
    } 
     
 
}
