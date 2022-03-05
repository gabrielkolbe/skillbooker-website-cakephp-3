<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * Salesoptions Controller
 *
 * @property \Manager\Model\Table\SalesoptionsTable $Salesoptions
 */
class SalesoptionsController extends AppController
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
        $salesoptions = $this->paginate($this->Salesoptions);

        $this->set(compact('salesoptions'));
        $this->set('_serialize', ['salesoptions']);
    }

    /**
     * View method
     *
     * @param string|null $id Salesoption id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesoption = $this->Salesoptions->get($id, [
            'contain' => []
        ]);

        $this->set('salesoption', $salesoption);
        $this->set('_serialize', ['salesoption']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesoption = $this->Salesoptions->newEntity();
        if ($this->request->is('post')) {
            $salesoption = $this->Salesoptions->patchEntity($salesoption, $this->request->data);
            if ($this->Salesoptions->save($salesoption)) {
                $this->Flash->success(__('The salesoption has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The salesoption could not be saved. Please, try again.'));
        }
        $this->set(compact('salesoption'));
        $this->set('_serialize', ['salesoption']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Salesoption id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesoption = $this->Salesoptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesoption = $this->Salesoptions->patchEntity($salesoption, $this->request->data);
            if ($this->Salesoptions->save($salesoption)) {
                $this->Flash->success(__('The salesoption has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The salesoption could not be saved. Please, try again.'));
        }
        $this->set(compact('salesoption'));
        $this->set('_serialize', ['salesoption']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Salesoption id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesoption = $this->Salesoptions->get($id);
        if ($this->Salesoptions->delete($salesoption)) {
            $this->Flash->success(__('The salesoption has been deleted.'));
        } else {
            $this->Flash->error(__('The salesoption could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
