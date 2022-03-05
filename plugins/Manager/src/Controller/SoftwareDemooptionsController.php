<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * SoftwareDemooptions Controller
 *
 * @property \Softmarket\Model\Table\SoftwareDemooptionsTable $SoftwareDemooptions
 */
class SoftwareDemooptionsController extends AppController
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
        $softwareDemooptions = $this->paginate($this->SoftwareDemooptions);

        $this->set(compact('softwareDemooptions'));
        $this->set('_serialize', ['softwareDemooptions']);
    }

    /**
     * View method
     *
     * @param string|null $id Software Demooption id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $softwareDemooption = $this->SoftwareDemooptions->get($id, [
            'contain' => []
        ]);

        $this->set('softwareDemooption', $softwareDemooption);
        $this->set('_serialize', ['softwareDemooption']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $softwareDemooption = $this->SoftwareDemooptions->newEntity();
        if ($this->request->is('post')) {
            $softwareDemooption = $this->SoftwareDemooptions->patchEntity($softwareDemooption, $this->request->data);
            if ($this->SoftwareDemooptions->save($softwareDemooption)) {
                $this->Flash->success(__('The software demooption has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software demooption could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareDemooption'));
        $this->set('_serialize', ['softwareDemooption']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Software Demooption id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $softwareDemooption = $this->SoftwareDemooptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $softwareDemooption = $this->SoftwareDemooptions->patchEntity($softwareDemooption, $this->request->data);
            if ($this->SoftwareDemooptions->save($softwareDemooption)) {
                $this->Flash->success(__('The software demooption has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The software demooption could not be saved. Please, try again.'));
        }
        $this->set(compact('softwareDemooption'));
        $this->set('_serialize', ['softwareDemooption']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Software Demooption id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $softwareDemooption = $this->SoftwareDemooptions->get($id);
        if ($this->SoftwareDemooptions->delete($softwareDemooption)) {
            $this->Flash->success(__('The software demooption has been deleted.'));
        } else {
            $this->Flash->error(__('The software demooption could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
