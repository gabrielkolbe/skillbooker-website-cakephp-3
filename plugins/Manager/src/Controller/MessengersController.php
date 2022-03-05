<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * Messengers Controller
 *
 * @property \Manager\Model\Table\MessengersTable $Messengers
 */
class MessengersController extends AppController
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
        $messengers = $this->paginate($this->Messengers);

        $this->set(compact('messengers'));
        $this->set('_serialize', ['messengers']);
    }

    /**
     * View method
     *
     * @param string|null $id Messenger id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $messenger = $this->Messengers->get($id, [
            'contain' => ['Users', 'Senders', 'Receivers']
        ]);

        $this->set('messenger', $messenger);
        $this->set('_serialize', ['messenger']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $messenger = $this->Messengers->newEntity();
        if ($this->request->is('post')) {
            $messenger = $this->Messengers->patchEntity($messenger, $this->request->data);
            if ($this->Messengers->save($messenger)) {
                $this->Flash->success(__('The messenger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The messenger could not be saved. Please, try again.'));
        }
        $users = $this->Messengers->Users->find('list', ['limit' => 200]);
        $this->set(compact('messenger', 'users', 'senders', 'receivers'));
        $this->set('_serialize', ['messenger']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Messenger id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $messenger = $this->Messengers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $messenger = $this->Messengers->patchEntity($messenger, $this->request->data);
            if ($this->Messengers->save($messenger)) {
                $this->Flash->success(__('The messenger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The messenger could not be saved. Please, try again.'));
        }
        $users = $this->Messengers->Users->find('list', ['limit' => 200]);

        $this->set(compact('messenger', 'users', 'senders', 'receivers'));
        $this->set('_serialize', ['messenger']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Messenger id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $messenger = $this->Messengers->get($id);
        if ($this->Messengers->delete($messenger)) {
            $this->Flash->success(__('The messenger has been deleted.'));
        } else {
            $this->Flash->error(__('The messenger could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
