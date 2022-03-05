<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * Urlviews Controller
 *
 * @property \Manager\Model\Table\UrlviewsTable $Urlviews
 */
class UrlviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'manager');  
        
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
            'contain' => ['Urlcontrollers']
        ];
        $urlviews = $this->paginate($this->Urlviews);

        $this->set(compact('urlviews'));
        $this->set('_serialize', ['urlviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Urlview id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $urlview = $this->Urlviews->get($id, [
            'contain' => ['Urlcontrollers']
        ]);

        $this->set('urlview', $urlview);
        $this->set('_serialize', ['urlview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $urlview = $this->Urlviews->newEntity();
        if ($this->request->is('post')) {
            $urlview = $this->Urlviews->patchEntity($urlview, $this->request->data);
            if ($this->Urlviews->save($urlview)) {
                $this->Flash->success(__('The urlview has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The urlview could not be saved. Please, try again.'));
        }
        $urlcontrollers = $this->Urlviews->Urlcontrollers->find('list', ['limit' => 200]);
        $this->set(compact('urlview', 'urlcontrollers'));
        $this->set('_serialize', ['urlview']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Urlview id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $urlview = $this->Urlviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $urlview = $this->Urlviews->patchEntity($urlview, $this->request->data);
            if ($this->Urlviews->save($urlview)) {
                $this->Flash->success(__('The urlview has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The urlview could not be saved. Please, try again.'));
        }
        $urlcontrollers = $this->Urlviews->Urlcontrollers->find('list', ['limit' => 200]);
        $this->set(compact('urlview', 'urlcontrollers'));
        $this->set('_serialize', ['urlview']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Urlview id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $urlview = $this->Urlviews->get($id);
        if ($this->Urlviews->delete($urlview)) {
            $this->Flash->success(__('The urlview has been deleted.'));
        } else {
            $this->Flash->error(__('The urlview could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
