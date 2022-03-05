<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Datedescs Controller
 *
 * @property \Jobs\Model\Table\DatedescsTable $Datedescs
 */
class DatedescsController extends AppController
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
        $datedescs = $this->paginate($this->Datedescs);

        $this->set(compact('datedescs'));
        $this->set('_serialize', ['datedescs']);
    }

    /**
     * View method
     *
     * @param string|null $id Datedesc id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $datedesc = $this->Datedescs->get($id, [
            'contain' => []
        ]);

        $this->set('datedesc', $datedesc);
        $this->set('_serialize', ['datedesc']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $datedesc = $this->Datedescs->newEntity();
        if ($this->request->is('post')) {
            $datedesc = $this->Datedescs->patchEntity($datedesc, $this->request->data);
            if ($this->Datedescs->save($datedesc)) {
                $this->Flash->success(__('The datedesc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The datedesc could not be saved. Please, try again.'));
        }
        $this->set(compact('datedesc'));
        $this->set('_serialize', ['datedesc']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Datedesc id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $datedesc = $this->Datedescs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $datedesc = $this->Datedescs->patchEntity($datedesc, $this->request->data);
            if ($this->Datedescs->save($datedesc)) {
                $this->Flash->success(__('The datedesc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The datedesc could not be saved. Please, try again.'));
        }
        $this->set(compact('datedesc'));
        $this->set('_serialize', ['datedesc']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Datedesc id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $datedesc = $this->Datedescs->get($id);
        if ($this->Datedescs->delete($datedesc)) {
            $this->Flash->success(__('The datedesc has been deleted.'));
        } else {
            $this->Flash->error(__('The datedesc could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
