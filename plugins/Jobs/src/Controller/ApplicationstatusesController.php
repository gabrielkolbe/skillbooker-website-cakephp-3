<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Applicationstatuses Controller
 *
 * @property \Jobs\Model\Table\ApplicationstatusesTable $Applicationstatuses
 */
class ApplicationstatusesController extends AppController
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
        $applicationstatuses = $this->paginate($this->Applicationstatuses);

        $this->set(compact('applicationstatuses'));
        $this->set('_serialize', ['applicationstatuses']);
    }

    /**
     * View method
     *
     * @param string|null $id Applicationstatus id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicationstatus = $this->Applicationstatuses->get($id, [
            'contain' => []
        ]);

        $this->set('applicationstatus', $applicationstatus);
        $this->set('_serialize', ['applicationstatus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicationstatus = $this->Applicationstatuses->newEntity();
        if ($this->request->is('post')) {
            $applicationstatus = $this->Applicationstatuses->patchEntity($applicationstatus, $this->request->data);
            if ($this->Applicationstatuses->save($applicationstatus)) {
                $this->Flash->success(__('The applicationstatus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicationstatus could not be saved. Please, try again.'));
        }
        $this->set(compact('applicationstatus'));
        $this->set('_serialize', ['applicationstatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicationstatus id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicationstatus = $this->Applicationstatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicationstatus = $this->Applicationstatuses->patchEntity($applicationstatus, $this->request->data);
            if ($this->Applicationstatuses->save($applicationstatus)) {
                $this->Flash->success(__('The applicationstatus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicationstatus could not be saved. Please, try again.'));
        }
        $this->set(compact('applicationstatus'));
        $this->set('_serialize', ['applicationstatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicationstatus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicationstatus = $this->Applicationstatuses->get($id);
        if ($this->Applicationstatuses->delete($applicationstatus)) {
            $this->Flash->success(__('The applicationstatus has been deleted.'));
        } else {
            $this->Flash->error(__('The applicationstatus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
