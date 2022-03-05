<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * Tabs Controller
 *
 * @property \Manager\Model\Table\TabsTable $Tabs
 */
class TabsController extends AppController
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
        $tabs = $this->paginate($this->Tabs);

        $this->set(compact('tabs'));
        $this->set('_serialize', ['tabs']);
    }

    /**
     * View method
     *
     * @param string|null $id Tab id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tab = $this->Tabs->get($id, [
            'contain' => []
        ]);

        $this->set('tab', $tab);
        $this->set('_serialize', ['tab']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tab = $this->Tabs->newEntity();
        if ($this->request->is('post')) {
            $tab = $this->Tabs->patchEntity($tab, $this->request->data);
            if ($this->Tabs->save($tab)) {
                $this->Flash->success(__('The tab has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tab could not be saved. Please, try again.'));

            Cache::delete('customroute');
            
        }
        $this->loadModel('Urlcontrollers');   
        $urlcontrollers = $this->Urlcontrollers->find('list', ['keyField' => 'name', 'valueField' => 'name']);
        
        $this->loadModel('Urlviews');   
        $urlviews = $this->Urlviews->find('list', ['keyField' => 'name', 'valueField' => 'name']);

        $this->set(compact('tab', 'urlcontrollers', 'urlviews'));
        $this->set('_serialize', ['tab']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tab id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tab = $this->Tabs->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tab = $this->Tabs->patchEntity($tab, $this->request->data);
            if ($this->Tabs->save($tab)) {
                $this->Flash->success(__('The tab has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tab could not be saved. Please, try again.'));
            }
            
            Cache::delete('customroute');
        }
        
        $this->loadModel('Urlcontrollers');   
        $urlcontrollers = $this->Urlcontrollers->find('list', ['keyField' => 'name', 'valueField' => 'name']);
        
        $this->loadModel('Urlviews');   
        $urlviews = $this->Urlviews->find('list', ['keyField' => 'name', 'valueField' => 'name']);

        $this->set(compact('tab', 'urlcontrollers', 'urlviews'));
        $this->set('_serialize', ['tab']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tab id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tab = $this->Tabs->get($id);
        if ($this->Tabs->delete($tab)) {
            $this->Flash->success(__('The tab has been deleted.'));
        } else {
            $this->Flash->error(__('The tab could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
}
