<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserStatuses Controller
 *
 * @property \Candidates\Model\Table\UserStatusesTable $UserStatuses
 */
class UserStatusesController extends AppController
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
        $userStatuses = $this->paginate($this->UserStatuses);

        $this->set(compact('userStatuses'));
        $this->set('_serialize', ['userStatuses']);
    }

    /**
     * View method
     *
     * @param string|null $id User Status id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userStatus = $this->UserStatuses->get($id, [
            'contain' => []
        ]);

        $this->set('userStatus', $userStatus);
        $this->set('_serialize', ['userStatus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userStatus = $this->UserStatuses->newEntity();
        if ($this->request->is('post')) {
            $userStatus = $this->UserStatuses->patchEntity($userStatus, $this->request->data);
            if ($this->UserStatuses->save($userStatus)) {
                $this->Flash->success(__('The user status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user status could not be saved. Please, try again.'));
        }
        $this->set(compact('userStatus'));
        $this->set('_serialize', ['userStatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Status id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userStatus = $this->UserStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userStatus = $this->UserStatuses->patchEntity($userStatus, $this->request->data);
            if ($this->UserStatuses->save($userStatus)) {
                $this->Flash->success(__('The user status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user status could not be saved. Please, try again.'));
        }
        $this->set(compact('userStatus'));
        $this->set('_serialize', ['userStatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Status id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userStatus = $this->UserStatuses->get($id);
        if ($this->UserStatuses->delete($userStatus)) {
            $this->Flash->success(__('The user status has been deleted.'));
        } else {
            $this->Flash->error(__('The user status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
