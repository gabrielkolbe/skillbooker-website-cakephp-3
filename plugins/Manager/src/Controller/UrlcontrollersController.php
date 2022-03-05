<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * Urlcontrollers Controller
 *
 * @property \Manager\Model\Table\UrlcontrollersTable $Urlcontrollers
 */
class UrlcontrollersController extends AppController
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
        $urlcontrollers = $this->paginate($this->Urlcontrollers);

        $this->set(compact('urlcontrollers'));
        $this->set('_serialize', ['urlcontrollers']);
    }

    /**
     * View method
     *
     * @param string|null $id Urlcontroller id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $urlcontroller = $this->Urlcontrollers->get($id, [
            'contain' => []
        ]);

        $this->set('urlcontroller', $urlcontroller);
        $this->set('_serialize', ['urlcontroller']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $urlcontroller = $this->Urlcontrollers->newEntity();
        if ($this->request->is('post')) {
            $urlcontroller = $this->Urlcontrollers->patchEntity($urlcontroller, $this->request->data);
            if ($this->Urlcontrollers->save($urlcontroller)) {
                $this->Flash->success(__('The urlcontroller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The urlcontroller could not be saved. Please, try again.'));
        }
        $this->set(compact('urlcontroller'));
        $this->set('_serialize', ['urlcontroller']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Urlcontroller id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $urlcontroller = $this->Urlcontrollers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $urlcontroller = $this->Urlcontrollers->patchEntity($urlcontroller, $this->request->data);
            if ($this->Urlcontrollers->save($urlcontroller)) {
                $this->Flash->success(__('The urlcontroller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The urlcontroller could not be saved. Please, try again.'));
        }
        $this->set(compact('urlcontroller'));
        $this->set('_serialize', ['urlcontroller']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Urlcontroller id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $urlcontroller = $this->Urlcontrollers->get($id);
        if ($this->Urlcontrollers->delete($urlcontroller)) {
            $this->Flash->success(__('The urlcontroller has been deleted.'));
        } else {
            $this->Flash->error(__('The urlcontroller could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
