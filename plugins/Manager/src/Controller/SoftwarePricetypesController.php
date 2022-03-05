<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * SoftwarePricetypes Controller
 *
 * @property \Softmarket\Model\Table\SoftwarePricetypesTable $SoftwarePricetypes
 */
class SoftwarePricetypesController extends AppController
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
        $softwarePricetypes = $this->paginate($this->SoftwarePricetypes);

        $this->set(compact('softwarePricetypes'));
        $this->set('_serialize', ['softwarePricetypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Software Pricetype id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $softwarePricetype = $this->SoftwarePricetypes->get($id, [
            'contain' => ['Softwares']
        ]);

        $this->set('softwarePricetype', $softwarePricetype);
        $this->set('_serialize', ['softwarePricetype']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $softwarePricetype = $this->SoftwarePricetypes->newEntity();
        if ($this->request->is('post')) {
            $softwarePricetype = $this->SoftwarePricetypes->patchEntity($softwarePricetype, $this->request->data);
            if ($this->SoftwarePricetypes->save($softwarePricetype)) {
                $this->Flash->success(__('The software pricetype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software pricetype could not be saved. Please, try again.'));
        }
        $this->set(compact('softwarePricetype'));
        $this->set('_serialize', ['softwarePricetype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Software Pricetype id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $softwarePricetype = $this->SoftwarePricetypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $softwarePricetype = $this->SoftwarePricetypes->patchEntity($softwarePricetype, $this->request->data);
            if ($this->SoftwarePricetypes->save($softwarePricetype)) {
                $this->Flash->success(__('The software pricetype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software pricetype could not be saved. Please, try again.'));
        }
        $this->set(compact('softwarePricetype'));
        $this->set('_serialize', ['softwarePricetype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Software Pricetype id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $softwarePricetype = $this->SoftwarePricetypes->get($id);
        if ($this->SoftwarePricetypes->delete($softwarePricetype)) {
            $this->Flash->success(__('The software pricetype has been deleted.'));
        } else {
            $this->Flash->error(__('The software pricetype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
