<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * TimesheetUsers Controller
 *
 * @property \App\Model\Table\TimesheetUsersTable $TimesheetUsers
 */
class TimesheetUsersController extends AppController
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
            'contain' => ['Roles'],
            'conditions'=>['TimesheetUsers.user_id = '.$user_id],
            'order' => ['TimesheetUsers.id' => 'DESC'] 
        ];

        $timesheetUsers = $this->paginate($this->TimesheetUsers);

        $this->set(compact('timesheetUsers'));
        $this->set('_serialize', ['timesheetUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Timesheet User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     /*
    public function view($id = null)
    {
        $timesheetUser = $this->TimesheetUsers->get($id, [
            'contain' => ['Users', 'Roles']
        ]);

        $this->set('timesheetUser', $timesheetUser);
        $this->set('_serialize', ['timesheetUser']);
    }  
    */

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('ajax');
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
             
        $timesheetUser = $this->TimesheetUsers->newEntity();
        
        $this->loadModel('Roles');
        $roles = $this->Roles->find('list', ['conditions' => ['Roles.section' => 1], 'limit' => 200]);
        

        $this->set(compact('timesheetUser', 'roles'));
        $this->set('_serialize', ['timesheetUser']);
    }
    
        public function addaction()
    {

        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
      
        $timesheetUser = $this->TimesheetUsers->newEntity();
        if ($this->request->is('post')) {
            $timesheetUser = $this->TimesheetUsers->patchEntity($timesheetUser, $this->request->data);
            
            
            $firstname = ucfirst($timesheetUser->firstname); 
            $timesheetUser->firstname = $firstname;
            
            $lastname = ucfirst($timesheetUser->lastname); 
            $timesheetUser->lastname = $lastname;
            
            $name = $firstname.' '.$lastname;
            $timesheetUser->name = $name;
            
            $email = strtolower($timesheetUser->email);
            $timesheetUser->email = $email;
            
            $this->loadComponent('slugcreator');
            $timesheetUser->slug = $this->slugcreator->userslug($name);
            
            $timesheetUser->user_id = $user_id;
            
            
            if ($this->TimesheetUsers->save($timesheetUser)) {
                $this->Flash->success(__('The timesheet user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timesheet user could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }


    }                                        
    /**
     * Edit method
     *

     * @param string|null $id Timesheet User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $this->viewBuilder()->layout('ajax');
        
        $user_id = $this->Auth->user('id');
        
        $timesheetUser = $this->TimesheetUsers->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $timesheetUser = $timesheetUser->first();      
        
        if(empty($timesheetUser->id)){
            $this->Flash->error(__('Sorry, this user does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'timesheetsUsers', 'action' => 'index']);
        }
        

        $this->loadModel('Roles');
        $roles = $this->Roles->find('list', ['conditions' => ['Roles.section' => 1], 'limit' => 200]);
        
        $this->set(compact('timesheetUser', 'roles'));
        $this->set('_serialize', ['timesheetUser']);
    }
    
        
        public function editaction()
    {
       if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $slug = $this->request->data['slug'];
        
        $timesheetUser = $this->TimesheetUsers->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $timesheetUser = $timesheetUser->first();      
        
        if(empty($timesheetUser->id)){
            $this->Flash->error(__('Sorry, this user does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'timesheetsUsers', 'action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timesheetUser = $this->TimesheetUsers->patchEntity($timesheetUser, $this->request->data);
            
            $firstname = ucfirst($timesheetUser->firstname); 
            $timesheetUser->firstname = $firstname;
            
            $lastname = ucfirst($timesheetUser->lastname); 
            $timesheetUser->lastname = $lastname;
            
            $name = $firstname.' '.$lastname;
            $timesheetUser->name = $name;
            
            $email = strtolower($timesheetUser->email);
            $timesheetUser->email = $email;
            
            $this->loadComponent('slugcreator');
            $timesheetUser->slug = $this->slugcreator->userslug($name);
            
            if ($this->TimesheetUsers->save($timesheetUser)) {
                $this->Flash->success(__('The timesheet user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timesheet user could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

    }

    /**
     * Delete method
     *
     * @param string|null $id Timesheet User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timesheetUser = $this->TimesheetUsers->get($id);
        if ($this->TimesheetUsers->delete($timesheetUser)) {
            $this->Flash->success(__('The timesheet user has been deleted.'));
        } else {
            $this->Flash->error(__('The timesheet user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
