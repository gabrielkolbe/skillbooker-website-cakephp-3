<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * SoftwareDeployments Controller
 *
 * @property \Softmarket\Model\Table\SoftwareDeploymentsTable $SoftwareDeployments
 */
class SoftwareDeploymentsController extends AppController
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
        $softwareDeployments = $this->paginate($this->SoftwareDeployments);

        $this->set(compact('softwareDeployments'));
        $this->set('_serialize', ['softwareDeployments']);
    }

    /**
     * View method
     *
     * @param string|null $id Software Deployment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $softwareDeployment = $this->SoftwareDeployments->get($id, [
            'contain' => []
        ]);

        $this->set('softwareDeployment', $softwareDeployment);
        $this->set('_serialize', ['softwareDeployment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $softwareDeployment = $this->SoftwareDeployments->newEntity();
        if ($this->request->is('post')) {
            $softwareDeployment = $this->SoftwareDeployments->patchEntity($softwareDeployment, $this->request->data);
            if ($this->SoftwareDeployments->save($softwareDeployment)) {
                $this->Flash->success(__('The software deployment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software deployment could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareDeployment'));
        $this->set('_serialize', ['softwareDeployment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Software Deployment id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $softwareDeployment = $this->SoftwareDeployments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $softwareDeployment = $this->SoftwareDeployments->patchEntity($softwareDeployment, $this->request->data);
            if ($this->SoftwareDeployments->save($softwareDeployment)) {
                $this->Flash->success(__('The software deployment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software deployment could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareDeployment'));
        $this->set('_serialize', ['softwareDeployment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Software Deployment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $softwareDeployment = $this->SoftwareDeployments->get($id);
        if ($this->SoftwareDeployments->delete($softwareDeployment)) {
            $this->Flash->success(__('The software deployment has been deleted.'));
        } else {
            $this->Flash->error(__('The software deployment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
