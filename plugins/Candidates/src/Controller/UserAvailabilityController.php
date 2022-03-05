<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserAvailability Controller
 *
 * @property \Candidates\Model\Table\UserAvailabilityTable $UserAvailability
 */
class UserAvailabilityController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'candidates');  
        
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
     
     
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $userAvailability = $this->paginate($this->UserAvailability);

        $this->set(compact('userAvailability'));
        $this->set('_serialize', ['userAvailability']);
    }

    /**
     * View method
     *
     * @param string|null $id User Availability id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userAvailability = $this->UserAvailability->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userAvailability', $userAvailability);
        $this->set('_serialize', ['userAvailability']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userAvailability = $this->UserAvailability->newEntity();
        if ($this->request->is('post')) {
            $userAvailability = $this->UserAvailability->patchEntity($userAvailability, $this->request->data);
            if ($this->UserAvailability->save($userAvailability)) {
                $this->Flash->success(__('The user availability has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user availability could not be saved. Please, try again.'));
        }
        $users = $this->UserAvailability->Users->find('list', ['limit' => 200]);
        $this->set(compact('userAvailability', 'users'));
        $this->set('_serialize', ['userAvailability']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Availability id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userAvailability = $this->UserAvailability->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userAvailability = $this->UserAvailability->patchEntity($userAvailability, $this->request->data);
            if ($this->UserAvailability->save($userAvailability)) {
                $this->Flash->success(__('The user availability has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user availability could not be saved. Please, try again.'));
        }
        $users = $this->UserAvailability->Users->find('list', ['limit' => 200]);
        $this->set(compact('userAvailability', 'users'));
        $this->set('_serialize', ['userAvailability']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Availability id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userAvailability = $this->UserAvailability->get($id);
        if ($this->UserAvailability->delete($userAvailability)) {
            $this->Flash->success(__('The user availability has been deleted.'));
        } else {
            $this->Flash->error(__('The user availability could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
