<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * States Controller
 *
 * @property \App\Model\Table\StatesTable $States
 */
class StatesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'manager');
        $this->Auth->allow('');
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
        $states = $this->paginate($this->States, ['conditions' => ['States.country_id' => DEFAULT_COUNTRYID]]);

        $this->set(compact('states'));
        $this->set('_serialize', ['states']);
    }

    /**
     * View method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => []
        ]);

        $this->set('state', $state);
        $this->set('_serialize', ['state']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $state = $this->States->newEntity();
        if ($this->request->is('post')) {
            $state = $this->States->patchEntity($state, $this->request->data);
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        }
        $countries = $this->States->Countries->find('list');
        
        $this->set(compact('state', 'countries'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Edit method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $state = $this->States->patchEntity($state, $this->request->data);
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        }
        
        $countries = $this->States->Countries->find('list');
        
        $this->set(compact('state', 'countries'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Delete method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $state = $this->States->get($id);
        if ($this->States->delete($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
public function populate($country_id) {

        $list = $this->States
          ->find('list', [
              'keyField' => 'id',
              'valueField' => 'name'
          ])
          ->where(['country_id =' => $country_id])
          ->toArray();
    
        $this->set('list', $list); 
        $this->viewBuilder()->layout('ajax');
        $this->render('populate');                               
      
} 
    

}
