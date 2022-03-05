<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Freelancers Controller
 *
 * @property \App\Model\Table\FreelancersTable $Freelancers
 */
class FreelancersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'project');
        $this->viewBuilder()->layout('front');  
        
    }
    
    public function isAuthorized($user)
    {
    
      if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to access this page.'));
          return $this->redirect(['controller' => 'users', 'action' => 'login']);
      } else {
          return true;
      }
         return parent::isAuthorized($user);
    }  
     
     
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $freelancers = $this->paginate($this->Freelancers);

        $this->set(compact('freelancers'));
        $this->set('_serialize', ['freelancers']);
    }

    /**
     * View method
     *
     * @param string|null $id Freelancer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $freelancer = $this->Freelancers->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('freelancer', $freelancer);
        $this->set('_serialize', ['freelancer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $freelancer = $this->Freelancers->newEntity();
        if ($this->request->is('post')) {
            $freelancer = $this->Freelancers->patchEntity($freelancer, $this->request->data);
            if ($this->Freelancers->save($freelancer)) {
                $this->Flash->success(__('The freelancer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The freelancer could not be saved. Please, try again.'));
        }
        $users = $this->Freelancers->Users->find('list', ['limit' => 200]);
        $this->set(compact('freelancer', 'users'));
        $this->set('_serialize', ['freelancer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Freelancer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $freelancer = $this->Freelancers->get($id);
        if ($this->Freelancers->delete($freelancer)) {
            $this->Flash->success(__('The freelancer has been deleted.'));
        } else {
            $this->Flash->error(__('The freelancer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
