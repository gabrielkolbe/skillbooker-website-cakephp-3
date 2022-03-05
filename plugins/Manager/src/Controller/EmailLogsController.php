<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * EmailLogs Controller
 *
 * @property \Manager\Model\Table\EmailLogsTable $EmailLogs
 */
class EmailLogsController extends AppController
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
        $this->paginate = [
            'contain' => ['EmailTemplates']
        ];
        $emailLogs = $this->paginate($this->EmailLogs);

        $this->set(compact('emailLogs'));
        $this->set('_serialize', ['emailLogs']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Log id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailLog = $this->EmailLogs->get($id, [
            'contain' => ['EmailTemplates']
        ]);

        $this->set('emailLog', $emailLog);
        $this->set('_serialize', ['emailLog']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailLog = $this->EmailLogs->newEntity();
        if ($this->request->is('post')) {
            $emailLog = $this->EmailLogs->patchEntity($emailLog, $this->request->data);
            if ($this->EmailLogs->save($emailLog)) {
                $this->Flash->success(__('The email log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email log could not be saved. Please, try again.'));
        }
        $emailTemplates = $this->EmailLogs->EmailTemplates->find('list', ['limit' => 200]);
        $this->set(compact('emailLog', 'emailTemplates'));
        $this->set('_serialize', ['emailLog']);
    }  

    /**
     * Edit method
     *
     * @param string|null $id Email Log id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailLog = $this->EmailLogs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailLog = $this->EmailLogs->patchEntity($emailLog, $this->request->data);
            if ($this->EmailLogs->save($emailLog)) {
                $this->Flash->success(__('The email log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email log could not be saved. Please, try again.'));
        }
        $emailTemplates = $this->EmailLogs->EmailTemplates->find('list', ['limit' => 200]);
        $this->set(compact('emailLog', 'emailTemplates'));
        $this->set('_serialize', ['emailLog']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Log id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailLog = $this->EmailLogs->get($id);
        if ($this->EmailLogs->delete($emailLog)) {
            $this->Flash->success(__('The email log has been deleted.'));
        } else {
            $this->Flash->error(__('The email log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
