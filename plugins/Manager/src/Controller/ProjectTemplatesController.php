<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * ProjectTemplates Controller
 *
 * @property \Manager\Model\Table\ProjectTemplatesTable $ProjectTemplates
 */
class ProjectTemplatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'projects');  
        
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
        $projectTemplates = $this->paginate($this->ProjectTemplates);

        $this->set(compact('projectTemplates'));
        $this->set('_serialize', ['projectTemplates']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Template id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectTemplate = $this->ProjectTemplates->get($id, [
            'contain' => []
        ]);

        $this->set('projectTemplate', $projectTemplate);
        $this->set('_serialize', ['projectTemplate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectTemplate = $this->ProjectTemplates->newEntity();
        if ($this->request->is('post')) {
            $projectTemplate = $this->ProjectTemplates->patchEntity($projectTemplate, $this->request->data);
            if ($this->ProjectTemplates->save($projectTemplate)) {
                $this->Flash->success(__('The project template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project template could not be saved. Please, try again.'));
        }
        $this->set(compact('projectTemplate'));
        $this->set('_serialize', ['projectTemplate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Template id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectTemplate = $this->ProjectTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectTemplate = $this->ProjectTemplates->patchEntity($projectTemplate, $this->request->data);
            if ($this->ProjectTemplates->save($projectTemplate)) {
                $this->Flash->success(__('The project template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project template could not be saved. Please, try again.'));
        }
        $this->set(compact('projectTemplate'));
        $this->set('_serialize', ['projectTemplate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Template id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectTemplate = $this->ProjectTemplates->get($id);
        if ($this->ProjectTemplates->delete($projectTemplate)) {
            $this->Flash->success(__('The project template has been deleted.'));
        } else {
            $this->Flash->error(__('The project template could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
