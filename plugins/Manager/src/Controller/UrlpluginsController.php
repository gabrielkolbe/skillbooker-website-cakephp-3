<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * Urlplugins Controller
 *
 * @property \Manager\Model\Table\UrlpluginsTable $Urlplugins
 */
class UrlpluginsController extends AppController
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
        $urlplugins = $this->paginate($this->Urlplugins);

        $this->set(compact('urlplugins'));
        $this->set('_serialize', ['urlplugins']);
    }

    /**
     * View method
     *
     * @param string|null $id Urlplugin id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $urlplugin = $this->Urlplugins->get($id, [
            'contain' => []
        ]);

        $this->set('urlplugin', $urlplugin);
        $this->set('_serialize', ['urlplugin']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $urlplugin = $this->Urlplugins->newEntity();
        if ($this->request->is('post')) {
            $urlplugin = $this->Urlplugins->patchEntity($urlplugin, $this->request->data);
            if ($this->Urlplugins->save($urlplugin)) {
                $this->Flash->success(__('The urlplugin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The urlplugin could not be saved. Please, try again.'));
        }
        $this->set(compact('urlplugin'));
        $this->set('_serialize', ['urlplugin']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Urlplugin id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $urlplugin = $this->Urlplugins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $urlplugin = $this->Urlplugins->patchEntity($urlplugin, $this->request->data);
            if ($this->Urlplugins->save($urlplugin)) {
                $this->Flash->success(__('The urlplugin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The urlplugin could not be saved. Please, try again.'));
        }
        $this->set(compact('urlplugin'));
        $this->set('_serialize', ['urlplugin']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Urlplugin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $urlplugin = $this->Urlplugins->get($id);
        if ($this->Urlplugins->delete($urlplugin)) {
            $this->Flash->success(__('The urlplugin has been deleted.'));
        } else {
            $this->Flash->error(__('The urlplugin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
