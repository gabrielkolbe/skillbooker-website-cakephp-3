<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * InvoiceEntries Controller
 *
 * @property \Invoicetracker\Model\Table\InvoiceEntriesTable $InvoiceEntries
 */
class InvoiceEntriesController extends AppController
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
        $this->paginate = [
            'contain' => ['Invoices', 'Users']
        ];
        $invoiceEntries = $this->paginate($this->InvoiceEntries);

        $this->set(compact('invoiceEntries'));
        $this->set('_serialize', ['invoiceEntries']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice Entry id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceEntry = $this->InvoiceEntries->get($id, [
            'contain' => ['Invoices', 'Users']
        ]);

        $this->set('invoiceEntry', $invoiceEntry);
        $this->set('_serialize', ['invoiceEntry']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoiceEntry = $this->InvoiceEntries->newEntity();
        if ($this->request->is('post')) {
            $invoiceEntry = $this->InvoiceEntries->patchEntity($invoiceEntry, $this->request->data);
            if ($this->InvoiceEntries->save($invoiceEntry)) {
                $this->Flash->success(__('The invoice entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice entry could not be saved. Please, try again.'));
        }
        $invoices = $this->InvoiceEntries->Invoices->find('list', ['limit' => 200]);
        $users = $this->InvoiceEntries->Users->find('list', ['limit' => 200]);
        $this->set(compact('invoiceEntry', 'invoices', 'users'));
        $this->set('_serialize', ['invoiceEntry']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Entry id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceEntry = $this->InvoiceEntries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceEntry = $this->InvoiceEntries->patchEntity($invoiceEntry, $this->request->data);
            if ($this->InvoiceEntries->save($invoiceEntry)) {
                $this->Flash->success(__('The invoice entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice entry could not be saved. Please, try again.'));
        }
        $invoices = $this->InvoiceEntries->Invoices->find('list', ['limit' => 200]);
        $users = $this->InvoiceEntries->Users->find('list', ['limit' => 200]);
        $this->set(compact('invoiceEntry', 'invoices', 'users'));
        $this->set('_serialize', ['invoiceEntry']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Entry id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceEntry = $this->InvoiceEntries->get($id);
        if ($this->InvoiceEntries->delete($invoiceEntry)) {
            $this->Flash->success(__('The invoice entry has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice entry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
