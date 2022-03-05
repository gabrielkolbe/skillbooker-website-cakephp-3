<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Jobtypes Controller
 *
 * @property \Jobs\Model\Table\JobtypesTable $Jobtypes
 */
class JobtypesController extends AppController
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
        $jobtypes = $this->paginate($this->Jobtypes);

        $this->set(compact('jobtypes'));
        $this->set('_serialize', ['jobtypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Jobtype id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $jobtype = $this->Jobtypes->get($id, [
            'contain' => ['Jobs']
        ]);

        $this->set('jobtype', $jobtype);
        $this->set('_serialize', ['jobtype']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $jobtype = $this->Jobtypes->newEntity();
        if ($this->request->is('post')) {
            $jobtype = $this->Jobtypes->patchEntity($jobtype, $this->request->data);
            if ($this->Jobtypes->save($jobtype)) {
                $this->Flash->success(__('The jobtype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jobtype could not be saved. Please, try again.'));
        }
        $this->set(compact('jobtype'));
        $this->set('_serialize', ['jobtype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Jobtype id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $jobtype = $this->Jobtypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jobtype = $this->Jobtypes->patchEntity($jobtype, $this->request->data);
            if ($this->Jobtypes->save($jobtype)) {
                $this->Flash->success(__('The jobtype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jobtype could not be saved. Please, try again.'));
        }
        $this->set(compact('jobtype'));
        $this->set('_serialize', ['jobtype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Jobtype id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jobtype = $this->Jobtypes->get($id);
        if ($this->Jobtypes->delete($jobtype)) {
            $this->Flash->success(__('The jobtype has been deleted.'));
        } else {
            $this->Flash->error(__('The jobtype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
