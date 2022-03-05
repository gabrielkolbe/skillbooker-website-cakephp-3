<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Subindustries Controller
 *
 * @property \Jobs\Model\Table\SubindustriesTable $Subindustries
 */
class SubindustriesController extends AppController
{
          public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'jobs');  
        
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
       
        $this->paginate = [
                'contain' => ['Industries']
        ];
    
        $subindustries = $this->paginate($this->Subindustries);

        $this->set(compact('subindustries'));
        $this->set('_serialize', ['subindustries']);
    }

    /**
     * View method
     *
     * @param string|null $id Subindustry id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subindustry = $this->Subindustries->get($id, [
            'contain' => []
        ]);

        $this->set('subindustry', $subindustry);
        $this->set('_serialize', ['subindustry']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subindustry = $this->Subindustries->newEntity();
        if ($this->request->is('post')) {
            $subindustry = $this->Subindustries->patchEntity($subindustry, $this->request->data);
            if ($this->Subindustries->save($subindustry)) {
                $this->Flash->success(__('The subindustry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subindustry could not be saved. Please, try again.'));
        }
        $industries = $this->Subindustries->Industries->find('list');
        
        $this->set(compact('subindustry', 'industries'));
        $this->set('_serialize', ['subindustry']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subindustry id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subindustry = $this->Subindustries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subindustry = $this->Subindustries->patchEntity($subindustry, $this->request->data);
            if ($this->Subindustries->save($subindustry)) {
                $this->Flash->success(__('The subindustry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subindustry could not be saved. Please, try again.'));
        }
        
        $industries = $this->Subindustries->Industries->find('list');
        
        $this->set(compact('subindustry', 'industries'));
        $this->set('_serialize', ['subindustry']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subindustry id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subindustry = $this->Subindustries->get($id);
        if ($this->Subindustries->delete($subindustry)) {
            $this->Flash->success(__('The subindustry has been deleted.'));
        } else {
            $this->Flash->error(__('The subindustry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function populate($industry_id) {

        $list = $this->Subindustries
          ->find('list', [
              'keyField' => 'id',
              'valueField' => 'name'
          ])
          ->where(['industry_id =' => $industry_id])
          ->toArray();
    
        $this->set('list', $list); 
        $this->viewBuilder()->layout('ajax');
        $this->render('populate');                               
      
}
}
