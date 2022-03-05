<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserEmployments Controller
 *
 * @property \Candidates\Model\Table\UserEmploymentsTable $UserEmployments
 */
class UserEmploymentsController extends AppController
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
        $userEmployments = $this->paginate($this->UserEmployments);

        $this->set(compact('userEmployments'));
        $this->set('_serialize', ['userEmployments']);
    }

    /**
     * View method
     *
     * @param string|null $id User Employment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userEmployment = $this->UserEmployments->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userEmployment', $userEmployment);
        $this->set('_serialize', ['userEmployment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userEmployment = $this->UserEmployments->newEntity();
        if ($this->request->is('post')) {
            $userEmployment = $this->UserEmployments->patchEntity($userEmployment, $this->request->data);
            if ($this->UserEmployments->save($userEmployment)) {
                $this->Flash->success(__('The user employment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user employment could not be saved. Please, try again.'));
        }
        $users = $this->UserEmployments->Users->find('list', ['limit' => 200]);
        $this->set(compact('userEmployment', 'users'));
        $this->set('_serialize', ['userEmployment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Employment id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userEmployment = $this->UserEmployments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userEmployment = $this->UserEmployments->patchEntity($userEmployment, $this->request->data);
            if ($this->UserEmployments->save($userEmployment)) {
                $this->Flash->success(__('The user employment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user employment could not be saved. Please, try again.'));
        }
        $users = $this->UserEmployments->Users->find('list', ['limit' => 200]);
        $this->set(compact('userEmployment', 'users'));
        $this->set('_serialize', ['userEmployment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Employment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userEmployment = $this->UserEmployments->get($id);
        if ($this->UserEmployments->delete($userEmployment)) {
            $this->Flash->success(__('The user employment has been deleted.'));
        } else {
            $this->Flash->error(__('The user employment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
