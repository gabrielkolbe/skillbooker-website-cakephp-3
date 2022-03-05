<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * SoftwareCategories Controller
 *
 * @property \Softmarket\Model\Table\SoftwareCategoriesTable $SoftwareCategories
 */
class SoftwareCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
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
     
     
    public function index()
    {
        $softwareCategories = $this->paginate($this->SoftwareCategories);

        $this->set(compact('softwareCategories'));
        $this->set('_serialize', ['softwareCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Software Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $softwareCategory = $this->SoftwareCategories->get($id, [
            'contain' => ['SoftwareFeatures', 'Softwares']
        ]);

        $this->set('softwareCategory', $softwareCategory);
        $this->set('_serialize', ['softwareCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $softwareCategory = $this->SoftwareCategories->newEntity();
        if ($this->request->is('post')) {
            $softwareCategory = $this->SoftwareCategories->patchEntity($softwareCategory, $this->request->data);
            if ($this->SoftwareCategories->save($softwareCategory)) {
                $this->Flash->success(__('The software category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software category could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareCategory'));
        $this->set('_serialize', ['softwareCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Software Category id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $softwareCategory = $this->SoftwareCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $softwareCategory = $this->SoftwareCategories->patchEntity($softwareCategory, $this->request->data);
            if ($this->SoftwareCategories->save($softwareCategory)) {
                $this->Flash->success(__('The software category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software category could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareCategory'));
        $this->set('_serialize', ['softwareCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Software Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $softwareCategory = $this->SoftwareCategories->get($id);
        if ($this->SoftwareCategories->delete($softwareCategory)) {
            $this->Flash->success(__('The software category has been deleted.'));
        } else {
            $this->Flash->error(__('The software category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
