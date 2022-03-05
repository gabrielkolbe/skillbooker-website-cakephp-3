<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * TimesheetProcesses Controller
 *
 * @property \Manager\Model\Table\TimesheetProcessesTable $TimesheetProcesses
 */
class TimesheetProcessesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'timesheets');  
        
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
        $timesheetProcesses = $this->paginate($this->TimesheetProcesses);

        $this->set(compact('timesheetProcesses'));
        $this->set('_serialize', ['timesheetProcesses']);
    }

    /**
     * View method
     *
     * @param string|null $id Timesheet Process id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timesheetProcess = $this->TimesheetProcesses->get($id, [
            'contain' => ['Timesheets']
        ]);

        $this->set('timesheetProcess', $timesheetProcess);
        $this->set('_serialize', ['timesheetProcess']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $timesheetProcess = $this->TimesheetProcesses->newEntity();
        if ($this->request->is('post')) {
            $timesheetProcess = $this->TimesheetProcesses->patchEntity($timesheetProcess, $this->request->data);
            if ($this->TimesheetProcesses->save($timesheetProcess)) {
                $this->Flash->success(__('The timesheet process has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timesheet process could not be saved. Please, try again.'));
        }
        $this->set(compact('timesheetProcess'));
        $this->set('_serialize', ['timesheetProcess']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Timesheet Process id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $timesheetProcess = $this->TimesheetProcesses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timesheetProcess = $this->TimesheetProcesses->patchEntity($timesheetProcess, $this->request->data);
            if ($this->TimesheetProcesses->save($timesheetProcess)) {
                $this->Flash->success(__('The timesheet process has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timesheet process could not be saved. Please, try again.'));
        }
        $this->set(compact('timesheetProcess'));
        $this->set('_serialize', ['timesheetProcess']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Timesheet Process id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timesheetProcess = $this->TimesheetProcesses->get($id);
        if ($this->TimesheetProcesses->delete($timesheetProcess)) {
            $this->Flash->success(__('The timesheet process has been deleted.'));
        } else {
            $this->Flash->error(__('The timesheet process could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
