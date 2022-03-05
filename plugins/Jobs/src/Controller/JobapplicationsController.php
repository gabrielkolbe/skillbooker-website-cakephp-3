<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Jobapplications Controller
 *
 * @property \Jobs\Model\Table\JobapplicationsTable $Jobapplications
 */
class JobapplicationsController extends AppController
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
        $jobapplications = $this->paginate($this->Jobapplications);

        $this->set(compact('jobapplications'));
        $this->set('_serialize', ['jobapplications']);
    }

    /**
     * View method
     *
     * @param string|null $id Jobapplication id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $jobapplication = $this->Jobapplications->get($id, [
            'contain' => []
        ]);

        $this->set('jobapplication', $jobapplication);
        $this->set('_serialize', ['jobapplication']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $jobapplication = $this->Jobapplications->newEntity();
        if ($this->request->is('post')) {
            $jobapplication = $this->Jobapplications->patchEntity($jobapplication, $this->request->data);
            if ($this->Jobapplications->save($jobapplication)) {
                $this->Flash->success(__('The jobapplication has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jobapplication could not be saved. Please, try again.'));
        }
        $this->set(compact('jobapplication'));
        $this->set('_serialize', ['jobapplication']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Jobapplication id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $jobapplication = $this->Jobapplications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jobapplication = $this->Jobapplications->patchEntity($jobapplication, $this->request->data);
            if ($this->Jobapplications->save($jobapplication)) {
                $this->Flash->success(__('The jobapplication has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jobapplication could not be saved. Please, try again.'));
        }
        $this->set(compact('jobapplication'));
        $this->set('_serialize', ['jobapplication']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Jobapplication id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jobapplication = $this->Jobapplications->get($id);
        if ($this->Jobapplications->delete($jobapplication)) {
            $this->Flash->success(__('The jobapplication has been deleted.'));
        } else {
            $this->Flash->error(__('The jobapplication could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
