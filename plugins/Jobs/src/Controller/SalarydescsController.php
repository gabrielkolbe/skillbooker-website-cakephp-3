<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Salarydescs Controller
 *
 * @property \Jobs\Model\Table\SalarydescsTable $Salarydescs
 */
class SalarydescsController extends AppController
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
        $salarydescs = $this->paginate($this->Salarydescs);

        $this->set(compact('salarydescs'));
        $this->set('_serialize', ['salarydescs']);
    }

    /**
     * View method
     *
     * @param string|null $id Salarydesc id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salarydesc = $this->Salarydescs->get($id, [
            'contain' => []
        ]);

        $this->set('salarydesc', $salarydesc);
        $this->set('_serialize', ['salarydesc']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salarydesc = $this->Salarydescs->newEntity();
        if ($this->request->is('post')) {
            $salarydesc = $this->Salarydescs->patchEntity($salarydesc, $this->request->data);
            if ($this->Salarydescs->save($salarydesc)) {
                $this->Flash->success(__('The salarydesc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The salarydesc could not be saved. Please, try again.'));
        }
        $this->set(compact('salarydesc'));
        $this->set('_serialize', ['salarydesc']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Salarydesc id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salarydesc = $this->Salarydescs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salarydesc = $this->Salarydescs->patchEntity($salarydesc, $this->request->data);
            if ($this->Salarydescs->save($salarydesc)) {
                $this->Flash->success(__('The salarydesc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The salarydesc could not be saved. Please, try again.'));
        }
        $this->set(compact('salarydesc'));
        $this->set('_serialize', ['salarydesc']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Salarydesc id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salarydesc = $this->Salarydescs->get($id);
        if ($this->Salarydescs->delete($salarydesc)) {
            $this->Flash->success(__('The salarydesc has been deleted.'));
        } else {
            $this->Flash->error(__('The salarydesc could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
