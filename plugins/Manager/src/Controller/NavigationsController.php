<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;
use Cake\Cache\Cache;

/**
 * Navigations Controller
 *
 * @property \Manager\Model\Table\NavigationsTable $Navigations
 */
class NavigationsController extends AppController
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
        $navigations = $this->paginate($this->Navigations);

        $this->set(compact('navigations'));
        $this->set('_serialize', ['navigations']);
    }

    /**
     * View method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $navigation = $this->Navigations->get($id, [
            'contain' => ['Tabs']
        ]);

        $this->set('navigation', $navigation);
        $this->set('_serialize', ['navigation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $navigation = $this->Navigations->newEntity();
        if ($this->request->is('post')) {

$navigationcache = Cache::read('navigation');
if(!empty($navigationcache)){        
Cache::delete('navigation');
}

$customroutecache = Cache::read('customroute');
if(!empty($customroutecache)){        
Cache::delete('customroute');
}


            $navigation = $this->Navigations->patchEntity($navigation, $this->request->data);
            if ($this->Navigations->save($navigation)) {
                $this->Flash->success(__('The navigation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The navigation could not be saved. Please, try again.'));
        }
        $tabs = $this->Navigations->Tabs->find('list', ['limit' => 200]);
        $this->set(compact('navigation', 'tabs'));
        $this->set('_serialize', ['navigation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $navigation = $this->Navigations->get($id, [
            'contain' => ['Tabs']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        
$navigationcache = Cache::read('navigation');
if(!empty($navigationcache)){        
Cache::delete('navigation');
}


$customroutecache = Cache::read('customroute');
if(!empty($customroutecache)){        
Cache::delete('customroute');
}

            $navigation = $this->Navigations->patchEntity($navigation, $this->request->data);
            if ($this->Navigations->save($navigation)) {
                $this->Flash->success(__('The navigation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The navigation could not be saved. Please, try again.'));
        }
        $tabs = $this->Navigations->Tabs->find('list', ['limit' => 200]);
        $this->set(compact('navigation', 'tabs'));
        $this->set('_serialize', ['navigation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $navigation = $this->Navigations->get($id);
        if ($this->Navigations->delete($navigation)) {
            $this->Flash->success(__('The navigation has been deleted.'));
        } else {
            $this->Flash->error(__('The navigation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
            public function sort($id)
    {
    
        $this->loadModel('Tabs');
        $tabs = $this->Tabs->find('all', [
            'conditions' => ['navigations_tabs.navigation_id = '.$id], 
            'join' => [
                  [
                      'table' => 'navigations_tabs',
                      'type' => 'LEFT',
                      'conditions' => ['`navigations_tabs`.`tab_id` = `Tabs`.`id`']
                  ]
            ],
            'order' => ['Tabs.displayorder' => 'ASC']
        ]);
        
        $this->set('tabs', $tabs);
        
        if ($this->request->is(['patch', 'post', 'put'])) {

          $tabids = $this->request->data['tabid'];
          foreach($tabids as $k => $v) {
          
          $order = $k + 1;
          
            $query = $this->Tabs->query();
            $query->update()
            ->set(['displayorder' => $order])
            ->where(['id' => $v])
            ->execute();
 
          }

Cache::delete('navigation');
          
          $this->Flash->error(__('Tab display order has been updated, and will reflect on the site.'));
        }
    }
}
