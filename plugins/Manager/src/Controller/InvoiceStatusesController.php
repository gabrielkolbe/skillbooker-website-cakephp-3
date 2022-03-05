<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * InvoiceStatuses Controller
 *
 * @property \Invoicetracker\Model\Table\InvoiceStatusesTable $InvoiceStatuses
 */
class InvoiceStatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'invoices');  
        
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
        $invoiceStatuses = $this->paginate($this->InvoiceStatuses);

        $this->set(compact('invoiceStatuses'));
        $this->set('_serialize', ['invoiceStatuses']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice Status id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceStatus = $this->InvoiceStatuses->get($id, [
            'contain' => ['Invoices']
        ]);

        $this->set('invoiceStatus', $invoiceStatus);
        $this->set('_serialize', ['invoiceStatus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoiceStatus = $this->InvoiceStatuses->newEntity();
        if ($this->request->is('post')) {
            $invoiceStatus = $this->InvoiceStatuses->patchEntity($invoiceStatus, $this->request->data);
            if ($this->InvoiceStatuses->save($invoiceStatus)) {
                $this->Flash->success(__('The invoice status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice status could not be saved. Please, try again.'));
        }
        $this->set(compact('invoiceStatus'));
        $this->set('_serialize', ['invoiceStatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Status id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceStatus = $this->InvoiceStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceStatus = $this->InvoiceStatuses->patchEntity($invoiceStatus, $this->request->data);
            if ($this->InvoiceStatuses->save($invoiceStatus)) {
                $this->Flash->success(__('The invoice status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice status could not be saved. Please, try again.'));
        }
        $this->set(compact('invoiceStatus'));
        $this->set('_serialize', ['invoiceStatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Status id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceStatus = $this->InvoiceStatuses->get($id);
        if ($this->InvoiceStatuses->delete($invoiceStatus)) {
            $this->Flash->success(__('The invoice status has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
