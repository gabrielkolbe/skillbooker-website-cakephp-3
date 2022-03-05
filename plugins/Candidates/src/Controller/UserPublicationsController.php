<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserPublications Controller
 *
 * @property \Candidates\Model\Table\UserPublicationsTable $UserPublications
 */
class UserPublicationsController extends AppController
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
        $userPublications = $this->paginate($this->UserPublications);

        $this->set(compact('userPublications'));
        $this->set('_serialize', ['userPublications']);
    }

    /**
     * View method
     *
     * @param string|null $id User Publication id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userPublication = $this->UserPublications->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userPublication', $userPublication);
        $this->set('_serialize', ['userPublication']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userPublication = $this->UserPublications->newEntity();
        if ($this->request->is('post')) {
            $userPublication = $this->UserPublications->patchEntity($userPublication, $this->request->data);
            if ($this->UserPublications->save($userPublication)) {
                $this->Flash->success(__('The user publication has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user publication could not be saved. Please, try again.'));
        }
        $users = $this->UserPublications->Users->find('list', ['limit' => 200]);
        $this->set(compact('userPublication', 'users'));
        $this->set('_serialize', ['userPublication']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Publication id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userPublication = $this->UserPublications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userPublication = $this->UserPublications->patchEntity($userPublication, $this->request->data);
            if ($this->UserPublications->save($userPublication)) {
                $this->Flash->success(__('The user publication has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user publication could not be saved. Please, try again.'));
        }
        $users = $this->UserPublications->Users->find('list', ['limit' => 200]);
        $this->set(compact('userPublication', 'users'));
        $this->set('_serialize', ['userPublication']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Publication id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userPublication = $this->UserPublications->get($id);
        if ($this->UserPublications->delete($userPublication)) {
            $this->Flash->success(__('The user publication has been deleted.'));
        } else {
            $this->Flash->error(__('The user publication could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
