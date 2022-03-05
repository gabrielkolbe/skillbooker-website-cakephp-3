<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * SoftwareTrainings Controller
 *
 * @property \Softmarket\Model\Table\SoftwareTrainingsTable $SoftwareTrainings
 */
class SoftwareTrainingsController extends AppController
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
        $softwareTrainings = $this->paginate($this->SoftwareTrainings);

        $this->set(compact('softwareTrainings'));
        $this->set('_serialize', ['softwareTrainings']);
    }

    /**
     * View method
     *
     * @param string|null $id Software Training id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $softwareTraining = $this->SoftwareTrainings->get($id, [
            'contain' => []
        ]);

        $this->set('softwareTraining', $softwareTraining);
        $this->set('_serialize', ['softwareTraining']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $softwareTraining = $this->SoftwareTrainings->newEntity();
        if ($this->request->is('post')) {
            $softwareTraining = $this->SoftwareTrainings->patchEntity($softwareTraining, $this->request->data);
            if ($this->SoftwareTrainings->save($softwareTraining)) {
                $this->Flash->success(__('The software training has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software training could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareTraining'));
        $this->set('_serialize', ['softwareTraining']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Software Training id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $softwareTraining = $this->SoftwareTrainings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $softwareTraining = $this->SoftwareTrainings->patchEntity($softwareTraining, $this->request->data);
            if ($this->SoftwareTrainings->save($softwareTraining)) {
                $this->Flash->success(__('The software training has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software training could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareTraining'));
        $this->set('_serialize', ['softwareTraining']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Software Training id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $softwareTraining = $this->SoftwareTrainings->get($id);
        if ($this->SoftwareTrainings->delete($softwareTraining)) {
            $this->Flash->success(__('The software training has been deleted.'));
        } else {
            $this->Flash->error(__('The software training could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
