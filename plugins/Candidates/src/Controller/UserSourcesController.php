<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserSources Controller
 *
 * @property \Candidates\Model\Table\UserSourcesTable $UserSources
 */
class UserSourcesController extends AppController
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
        $userSources = $this->paginate($this->UserSources);

        $this->set(compact('userSources'));
        $this->set('_serialize', ['userSources']);
    }

    /**
     * View method
     *
     * @param string|null $id User Source id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userSource = $this->UserSources->get($id, [
            'contain' => []
        ]);

        $this->set('userSource', $userSource);
        $this->set('_serialize', ['userSource']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userSource = $this->UserSources->newEntity();
        if ($this->request->is('post')) {
            $userSource = $this->UserSources->patchEntity($userSource, $this->request->data);
            if ($this->UserSources->save($userSource)) {
                $this->Flash->success(__('The user source has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user source could not be saved. Please, try again.'));
        }
        $this->set(compact('userSource'));
        $this->set('_serialize', ['userSource']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Source id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userSource = $this->UserSources->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userSource = $this->UserSources->patchEntity($userSource, $this->request->data);
            if ($this->UserSources->save($userSource)) {
                $this->Flash->success(__('The user source has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user source could not be saved. Please, try again.'));
        }
        $this->set(compact('userSource'));
        $this->set('_serialize', ['userSource']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Source id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userSource = $this->UserSources->get($id);
        if ($this->UserSources->delete($userSource)) {
            $this->Flash->success(__('The user source has been deleted.'));
        } else {
            $this->Flash->error(__('The user source could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
