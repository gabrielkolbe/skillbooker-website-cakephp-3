<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * SoftwareSupports Controller
 *
 * @property \Softmarket\Model\Table\SoftwareSupportsTable $SoftwareSupports
 */
class SoftwareSupportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
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
     
     
    public function index()
    {
        $softwareSupports = $this->paginate($this->SoftwareSupports);

        $this->set(compact('softwareSupports'));
        $this->set('_serialize', ['softwareSupports']);
    }

    /**
     * View method
     *
     * @param string|null $id Software Support id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $softwareSupport = $this->SoftwareSupports->get($id, [
            'contain' => []
        ]);

        $this->set('softwareSupport', $softwareSupport);
        $this->set('_serialize', ['softwareSupport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $softwareSupport = $this->SoftwareSupports->newEntity();
        if ($this->request->is('post')) {
            $softwareSupport = $this->SoftwareSupports->patchEntity($softwareSupport, $this->request->data);
            if ($this->SoftwareSupports->save($softwareSupport)) {
                $this->Flash->success(__('The software support has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software support could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareSupport'));
        $this->set('_serialize', ['softwareSupport']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Software Support id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $softwareSupport = $this->SoftwareSupports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $softwareSupport = $this->SoftwareSupports->patchEntity($softwareSupport, $this->request->data);
            if ($this->SoftwareSupports->save($softwareSupport)) {
                $this->Flash->success(__('The software support has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software support could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareSupport'));
        $this->set('_serialize', ['softwareSupport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Software Support id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $softwareSupport = $this->SoftwareSupports->get($id);
        if ($this->SoftwareSupports->delete($softwareSupport)) {
            $this->Flash->success(__('The software support has been deleted.'));
        } else {
            $this->Flash->error(__('The software support could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
