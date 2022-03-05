<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * Custompages Controller
 *
 * @property \App\Model\Table\CustompagesTable $Custompages
 */
class CustompagesController extends AppController
{
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
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {   
        $this->paginate = [
            'order' => ['Custompages.id' => 'DESC']
        ];
        
        $custompages = $this->paginate($this->Custompages);

        $this->set(compact('custompages'));
        $this->set('_serialize', ['custompages']);
    }

    /**
     * View method
     *
     * @param string|null $id Custompage id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $custompage = $this->Custompages->get($id, [
            'contain' => []
        ]);

        $this->set('custompage', $custompage);
        $this->set('_serialize', ['custompage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $custompage = $this->Custompages->newEntity();
        if ($this->request->is('post')) {
            $custompage = $this->Custompages->patchEntity($custompage, $this->request->data);
            
            $title = ucwords($custompage->title);
            $custompage->title = $title ;
            
            $this->loadComponent('slugcreator');
            $custompage->slug = $this->slugcreator->generateslug($title); 
            
            
            if ($this->Custompages->save($custompage)) {
                $this->Flash->success(__('The custompage has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custompage could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('custompage'));
        $this->set('_serialize', ['custompage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Custompage id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $custompage = $this->Custompages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $custompage = $this->Custompages->patchEntity($custompage, $this->request->data);
            
            $title = ucwords($custompage->title);
            $custompage->title = $title ;

            if ($this->Custompages->save($custompage)) {
                $this->Flash->success(__('The custompage has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custompage could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('custompage'));
        $this->set('_serialize', ['custompage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Custompage id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $custompage = $this->Custompages->get($id);
        if ($this->Custompages->delete($custompage)) {
            $this->Flash->success(__('The custompage has been deleted.'));
        } else {
            $this->Flash->error(__('The custompage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
