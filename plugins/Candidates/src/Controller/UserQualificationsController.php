<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserQualifications Controller
 *
 * @property \Candidates\Model\Table\UserQualificationsTable $UserQualifications
 */
class UserQualificationsController extends AppController
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
            'contain' => ['Users', 'Countries']
        ];
        $userQualifications = $this->paginate($this->UserQualifications);

        $this->set(compact('userQualifications'));
        $this->set('_serialize', ['userQualifications']);
    }

    /**
     * View method
     *
     * @param string|null $id User Qualification id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userQualification = $this->UserQualifications->get($id, [
            'contain' => ['Users', 'Countries']
        ]);

        $this->set('userQualification', $userQualification);
        $this->set('_serialize', ['userQualification']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userQualification = $this->UserQualifications->newEntity();
        if ($this->request->is('post')) {
            $userQualification = $this->UserQualifications->patchEntity($userQualification, $this->request->data);
            if ($this->UserQualifications->save($userQualification)) {
                $this->Flash->success(__('The user qualification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user qualification could not be saved. Please, try again.'));
        }
        $users = $this->UserQualifications->Users->find('list', ['limit' => 200]);
        $countries = $this->UserQualifications->Countries->find('list', ['limit' => 200]);
        $this->set(compact('userQualification', 'users', 'countries'));
        $this->set('_serialize', ['userQualification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Qualification id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userQualification = $this->UserQualifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userQualification = $this->UserQualifications->patchEntity($userQualification, $this->request->data);
            if ($this->UserQualifications->save($userQualification)) {
                $this->Flash->success(__('The user qualification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user qualification could not be saved. Please, try again.'));
        }
        $users = $this->UserQualifications->Users->find('list', ['limit' => 200]);
        $countries = $this->UserQualifications->Countries->find('list', ['limit' => 200]);
        $this->set(compact('userQualification', 'users', 'countries'));
        $this->set('_serialize', ['userQualification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Qualification id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userQualification = $this->UserQualifications->get($id);
        if ($this->UserQualifications->delete($userQualification)) {
            $this->Flash->success(__('The user qualification has been deleted.'));
        } else {
            $this->Flash->error(__('The user qualification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
