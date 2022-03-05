<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserResumes Controller
 *
 * @property \Candidates\Model\Table\UserResumesTable $UserResumes
 */
class UserResumesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'candidates');  
        
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
            'contain' => ['Users']
        ];
        $userResumes = $this->paginate($this->UserResumes);

        $this->set(compact('userResumes'));
        $this->set('_serialize', ['userResumes']);
    }

    /**
     * View method
     *
     * @param string|null $id User Resume id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userResume = $this->UserResumes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userResume', $userResume);
        $this->set('_serialize', ['userResume']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userResume = $this->UserResumes->newEntity();
        if ($this->request->is('post')) {
            $userResume = $this->UserResumes->patchEntity($userResume, $this->request->data);
            if ($this->UserResumes->save($userResume)) {
                $this->Flash->success(__('The user resume has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user resume could not be saved. Please, try again.'));
        }
        $users = $this->UserResumes->Users->find('list', ['limit' => 200]);
        $this->set(compact('userResume', 'users'));
        $this->set('_serialize', ['userResume']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Resume id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userResume = $this->UserResumes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userResume = $this->UserResumes->patchEntity($userResume, $this->request->data);
            if ($this->UserResumes->save($userResume)) {
                $this->Flash->success(__('The user resume has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user resume could not be saved. Please, try again.'));
        }
        $users = $this->UserResumes->Users->find('list', ['limit' => 200]);
        $this->set(compact('userResume', 'users'));
        $this->set('_serialize', ['userResume']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Resume id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userResume = $this->UserResumes->get($id);
        if ($this->UserResumes->delete($userResume)) {
            $this->Flash->success(__('The user resume has been deleted.'));
        } else {
            $this->Flash->error(__('The user resume could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
