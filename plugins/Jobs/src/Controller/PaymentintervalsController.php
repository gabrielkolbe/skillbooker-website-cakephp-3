<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Paymentintervals Controller
 *
 * @property \Jobs\Model\Table\PaymentintervalsTable $Paymentintervals
 */
class PaymentintervalsController extends AppController
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
        $paymentintervals = $this->paginate($this->Paymentintervals);

        $this->set(compact('paymentintervals'));
        $this->set('_serialize', ['paymentintervals']);
    }

    /**
     * View method
     *
     * @param string|null $id Paymentinterval id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentinterval = $this->Paymentintervals->get($id, [
            'contain' => []
        ]);

        $this->set('paymentinterval', $paymentinterval);
        $this->set('_serialize', ['paymentinterval']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paymentinterval = $this->Paymentintervals->newEntity();
        if ($this->request->is('post')) {
            $paymentinterval = $this->Paymentintervals->patchEntity($paymentinterval, $this->request->data);
            if ($this->Paymentintervals->save($paymentinterval)) {
                $this->Flash->success(__('The paymentinterval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paymentinterval could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentinterval'));
        $this->set('_serialize', ['paymentinterval']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Paymentinterval id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paymentinterval = $this->Paymentintervals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentinterval = $this->Paymentintervals->patchEntity($paymentinterval, $this->request->data);
            if ($this->Paymentintervals->save($paymentinterval)) {
                $this->Flash->success(__('The paymentinterval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paymentinterval could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentinterval'));
        $this->set('_serialize', ['paymentinterval']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Paymentinterval id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paymentinterval = $this->Paymentintervals->get($id);
        if ($this->Paymentintervals->delete($paymentinterval)) {
            $this->Flash->success(__('The paymentinterval has been deleted.'));
        } else {
            $this->Flash->error(__('The paymentinterval could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
