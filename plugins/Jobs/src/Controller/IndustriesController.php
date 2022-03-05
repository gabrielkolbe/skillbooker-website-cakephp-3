<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Industries Controller
 *
 * @property \Jobs\Model\Table\IndustriesTable $Industries
 */
class IndustriesController extends AppController
{
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
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $industries = $this->paginate($this->Industries);

        $this->set(compact('industries'));
        $this->set('_serialize', ['industries']);
    }

    /**
     * View method
     *
     * @param string|null $id Industry id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $industry = $this->Industries->get($id, [
            'contain' => ['Jobs', 'Subindustries']
        ]);

        $this->set('industry', $industry);
        $this->set('_serialize', ['industry']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $industry = $this->Industries->newEntity();
        if ($this->request->is('post')) {
            $industry = $this->Industries->patchEntity($industry, $this->request->data);
            if ($this->Industries->save($industry)) {
                $this->Flash->success(__('The industry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The industry could not be saved. Please, try again.'));
        }
        $this->set(compact('industry'));
        $this->set('_serialize', ['industry']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Industry id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $industry = $this->Industries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $industry = $this->Industries->patchEntity($industry, $this->request->data);
            if ($this->Industries->save($industry)) {
                $this->Flash->success(__('The industry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The industry could not be saved. Please, try again.'));
        }
        $this->set(compact('industry'));
        $this->set('_serialize', ['industry']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Industry id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $industry = $this->Industries->get($id);
        if ($this->Industries->delete($industry)) {
            $this->Flash->success(__('The industry has been deleted.'));
        } else {
            $this->Flash->error(__('The industry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
