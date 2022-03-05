<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Contactmethods Controller
 *
 * @property \Jobs\Model\Table\ContactmethodsTable $Contactmethods
 */
class ContactmethodsController extends AppController
{
        public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'jobs');  
        
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
        $contactmethods = $this->paginate($this->Contactmethods);

        $this->set(compact('contactmethods'));
        $this->set('_serialize', ['contactmethods']);
    }

    /**
     * View method
     *
     * @param string|null $id Contactmethod id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactmethod = $this->Contactmethods->get($id, [
            'contain' => []
        ]);

        $this->set('contactmethod', $contactmethod);
        $this->set('_serialize', ['contactmethod']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactmethod = $this->Contactmethods->newEntity();
        if ($this->request->is('post')) {
            $contactmethod = $this->Contactmethods->patchEntity($contactmethod, $this->request->data);
            if ($this->Contactmethods->save($contactmethod)) {
                $this->Flash->success(__('The contactmethod has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contactmethod could not be saved. Please, try again.'));
        }
        $this->set(compact('contactmethod'));
        $this->set('_serialize', ['contactmethod']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contactmethod id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactmethod = $this->Contactmethods->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactmethod = $this->Contactmethods->patchEntity($contactmethod, $this->request->data);
            if ($this->Contactmethods->save($contactmethod)) {
                $this->Flash->success(__('The contactmethod has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contactmethod could not be saved. Please, try again.'));
        }
        $this->set(compact('contactmethod'));
        $this->set('_serialize', ['contactmethod']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contactmethod id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactmethod = $this->Contactmethods->get($id);
        if ($this->Contactmethods->delete($contactmethod)) {
            $this->Flash->success(__('The contactmethod has been deleted.'));
        } else {
            $this->Flash->error(__('The contactmethod could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
