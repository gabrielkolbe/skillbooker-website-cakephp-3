<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'manager');
        
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
    
    if ($this->request->is('post')) {
    //return debug($this->request->data);
        $pes = '%'.$this->request->data('search').'%';
        
        $query = $this->Users->find('all')
        ->where(['OR' => ['Users.name LIKE' => $pes, 'Users.firstname LIKE' => $pes, 'Users.lastname LIKE' => $pes]])
       ->contain(['Roles'])
       ->order(['Users.id' => 'DESC']);
        $this->set('users', $this->paginate($query));
        
    } else {
    
        $this->paginate = [
                'contain' => ['Roles'],
                'order' => ['Users.id' => 'DESC']
        ];
    
        $users = $this->paginate($this->Users);
    }

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Countries', 'States']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            //dd($this->request->data);
                        
            $firstname = ucfirst($user->firstname); 
            $user->firstname = $firstname;
            
            $lastname = ucfirst($user->lastname); 
            $user->lastname = $lastname;
            
            $name = $firstname.' '.$lastname;
            $user->name = $name;
            
            $email = strtolower($user->email);
            $user->email = $email;
 
            $verify_validate_string = Security::hash($email . time(), 'sha1', true);
            $user->validate_string = $verify_validate_string; 
            
            $this->loadComponent('slugcreator');
            $user->slug = $this->slugcreator->userslug($name);
            
            $user->password = '$2y$10$JuK6wevPp1u5MGF/9605dujlOYT1x8eYFPc96S9bCkQz3EMVzuuZW';  
          
            if ($this->Users->save($user)) {
                                            
                $this->Flash->success(__('The user has been saved, and email verification has been send out. Default password 123' ));
                return $this->redirect(['controller' => 'users', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }        
        
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);

        $this->set(compact('user', 'countries', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            
            $firstname = ucfirst($user->firstname); 
            $user->firstname = $firstname;
            
            $lastname = ucfirst($user->lastname); 
            $user->lastname = $lastname;
            
            $name = $firstname.' '.$lastname;
            $user->name = $name;
            
            $user->email = strtolower($user->email);
            $user->town = ucfirst($user->town);
            $user->jobtitle = ucfirst($user->jobtitle);
            $user->company = ucfirst($user->company);
          
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'users', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);

        $this->set(compact('user', 'countries', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
          
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
 
}
