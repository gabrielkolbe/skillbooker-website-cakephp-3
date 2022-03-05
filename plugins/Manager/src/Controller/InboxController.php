<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * ContactHistory Controller
 *
 * @property \App\Model\Table\ContactHistoryTable $ContactHistory
 */
class InboxController extends AppController
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
          return $this->redirect('/pages/home');
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
        $contactHistory = $this->paginate($this->Inbox, [
           'order' => ['Inbox.id' => 'DESC']
        ]);

        $this->set(compact('contactHistory'));
        $this->set('_serialize', ['contactHistory']);
    }

    /**
     * View method
     *
     * @param string|null $id Contact History id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactHistory = $this->Inbox->get($id, [
            'contain' => []
        ]);

        $this->set('contactHistory', $contactHistory);
        $this->set('_serialize', ['contactHistory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactHistory = $this->Inbox->newEntity();
        if ($this->request->is('post')) {
            $contactHistory = $this->Inbox->patchEntity($contactHistory, $this->request->data);
            if ($this->Inbox->save($contactHistory)) {
                $this->Flash->success(__('The contact history has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contact history could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contactHistory'));
        $this->set('_serialize', ['contactHistory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact History id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactHistory = $this->Inbox->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactHistory = $this->Inbox->patchEntity($contactHistory, $this->request->data);
            if ($this->ContactHistory->save($contactHistory)) {
                $this->Flash->success(__('The contact history has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contact history could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contactHistory'));
        $this->set('_serialize', ['contactHistory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact History id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactHistory = $this->Inbox->get($id);
        if ($this->Inbox->delete($contactHistory)) {
            $this->Flash->success(__('The contact history has been deleted.'));
        } else {
            $this->Flash->error(__('The contact history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
