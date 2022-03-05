<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * EmailTemplates Controller
 *
 * @property \App\Model\Table\EmailTemplatesTable $EmailTemplates
 */
class EmailTemplatesController extends AppController
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
            'contain' => ['EmailLayouts'],
            'order' => ['EmailTemplates.id' => 'DESC']
        ];
        $emailTemplates = $this->paginate($this->EmailTemplates);

        $this->set(compact('emailTemplates'));
        $this->set('_serialize', ['emailTemplates']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => ['EmailLayouts']
        ]);

        $this->set('emailTemplate', $emailTemplate);
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailTemplate = $this->EmailTemplates->newEntity();
        if ($this->request->is('post')) { 
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->data);
            $emailTemplate->isdefault = 0;
            
            if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The email template could not be saved. Please, try again.'));
            }
        }
        
      $layouts = $this->EmailTemplates->EmailLayouts->find('list');
                
                
        $this->set(compact('emailTemplate', 'layouts'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        

            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->data);
            if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The email template could not be saved. Please, try again.'));
            }
        }
        
        $layouts = $this->EmailTemplates->EmailLayouts->find('list');
        
        $this->set(compact('emailTemplate', 'layouts'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailTemplate = $this->EmailTemplates->get($id);
        if ($this->EmailTemplates->delete($emailTemplate)) {
            $this->Flash->success(__('The email template has been deleted.'));
        } else {
            $this->Flash->error(__('The email template could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
        public function test($id = null)
    {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => ['EmailLayouts']
        ]);
        
                  $keysvalues = explode(",", $emailTemplate->constants);
                  $keys = array();
                  foreach($keysvalues as $k => $v){
                   $keys[$k] = $v;
                  }
                  
                  $sendvalues = array();
                  $sendvalues['to'] = DEFAULT_SITE_EMAIL;
                  $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
                  $sendvalues['keys'] = $keys;
                  $sendvalues['templateid'] = $id;
                  
                  $this->loadComponent('Emailc');                  
                  $emailc = $this->Emailc->send_email($sendvalues); 

        $this->Flash->success(__('The email has been send to the site default email address '.DEFAULT_SITE_EMAIL));
        return $this->redirect(['action' => 'index']);
        
    }
    
}
