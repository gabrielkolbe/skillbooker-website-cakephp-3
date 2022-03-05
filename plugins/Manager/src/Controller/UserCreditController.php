<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * UserCredit Controller
 *
 * @property \manager\Model\Table\UserCreditTable $UserCredit
 */
class UserCreditController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
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
     
     
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $userCredit = $this->paginate($this->UserCredit);

        $this->set(compact('userCredit'));
        $this->set('_serialize', ['userCredit']);
    }

    /**
     * View method
     *
     * @param string|null $id User Credit id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userCredit = $this->UserCredit->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userCredit', $userCredit);
        $this->set('_serialize', ['userCredit']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userCredit = $this->UserCredit->newEntity();
        if ($this->request->is('post')) {
            $userCredit = $this->UserCredit->patchEntity($userCredit, $this->request->data);
            if ($this->UserCredit->save($userCredit)) {
                $this->Flash->success(__('The user credit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user credit could not be saved. Please, try again.'));
        }
        $users = $this->UserCredit->Users->find('list', ['limit' => 200]);
        $this->set(compact('userCredit', 'users'));
        $this->set('_serialize', ['userCredit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Credit id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userCredit = $this->UserCredit->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userCredit = $this->UserCredit->patchEntity($userCredit, $this->request->data);
            if ($this->UserCredit->save($userCredit)) {
                $this->Flash->success(__('The user credit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user credit could not be saved. Please, try again.'));
        }
        $users = $this->UserCredit->Users->find('list', ['limit' => 200]);
        $this->set(compact('userCredit', 'users'));
        $this->set('_serialize', ['userCredit']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Credit id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userCredit = $this->UserCredit->get($id);
        if ($this->UserCredit->delete($userCredit)) {
            $this->Flash->success(__('The user credit has been deleted.'));
        } else {
            $this->Flash->error(__('The user credit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
