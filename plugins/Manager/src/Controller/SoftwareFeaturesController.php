<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * SoftwareFeatures Controller
 *
 * @property \Softmarket\Model\Table\SoftwareFeaturesTable $SoftwareFeatures
 */
class SoftwareFeaturesController extends AppController
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
        $this->paginate = [
            'contain' => ['SoftwareCategories']
        ];
        $softwareFeatures = $this->paginate($this->SoftwareFeatures);

        $this->set(compact('softwareFeatures'));
        $this->set('_serialize', ['softwareFeatures']);
    }

    /**
     * View method
     *
     * @param string|null $id Software Feature id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $softwareFeature = $this->SoftwareFeatures->get($id, [
            'contain' => ['SoftwareCategories']
        ]);

        $this->set('softwareFeature', $softwareFeature);
        $this->set('_serialize', ['softwareFeature']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $softwareFeature = $this->SoftwareFeatures->newEntity();
        if ($this->request->is('post')) {
            $softwareFeature = $this->SoftwareFeatures->patchEntity($softwareFeature, $this->request->data);
            if ($this->SoftwareFeatures->save($softwareFeature)) {
                $this->Flash->success(__('The software feature has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software feature could not be saved. Please, try again.'));
        }
        $softwareCategories = $this->SoftwareFeatures->SoftwareCategories->find('list', ['limit' => 200]);
        $this->set(compact('softwareFeature', 'softwareCategories'));
        $this->set('_serialize', ['softwareFeature']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Software Feature id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $softwareFeature = $this->SoftwareFeatures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $softwareFeature = $this->SoftwareFeatures->patchEntity($softwareFeature, $this->request->data);
            if ($this->SoftwareFeatures->save($softwareFeature)) {
                $this->Flash->success(__('The software feature has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software feature could not be saved. Please, try again.'));
        }
        $softwareCategories = $this->SoftwareFeatures->SoftwareCategories->find('list', ['limit' => 200]);
        $this->set(compact('softwareFeature', 'softwareCategories'));
        $this->set('_serialize', ['softwareFeature']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Software Feature id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $softwareFeature = $this->SoftwareFeatures->get($id);
        if ($this->SoftwareFeatures->delete($softwareFeature)) {
            $this->Flash->success(__('The software feature has been deleted.'));
        } else {
            $this->Flash->error(__('The software feature could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
