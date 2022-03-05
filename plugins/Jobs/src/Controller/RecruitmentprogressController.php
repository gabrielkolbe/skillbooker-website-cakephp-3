<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Recruitmentprogress Controller
 *
 * @property \Jobs\Model\Table\RecruitmentprogressTable $Recruitmentprogress
 */
class RecruitmentprogressController extends AppController
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
        $recruitmentprogress = $this->paginate($this->Recruitmentprogress);

        $this->set(compact('recruitmentprogress'));
        $this->set('_serialize', ['recruitmentprogress']);
    }

    /**
     * View method
     *
     * @param string|null $id Recruitmentprogres id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $recruitmentprogres = $this->Recruitmentprogress->get($id, [
            'contain' => []
        ]);

        $this->set('recruitmentprogres', $recruitmentprogres);
        $this->set('_serialize', ['recruitmentprogres']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recruitmentprogres = $this->Recruitmentprogress->newEntity();
        if ($this->request->is('post')) {
            $recruitmentprogres = $this->Recruitmentprogress->patchEntity($recruitmentprogres, $this->request->data);
            if ($this->Recruitmentprogress->save($recruitmentprogres)) {
                $this->Flash->success(__('The recruitmentprogres has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The recruitmentprogres could not be saved. Please, try again.'));
        }
        $this->set(compact('recruitmentprogres'));
        $this->set('_serialize', ['recruitmentprogres']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Recruitmentprogres id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $recruitmentprogres = $this->Recruitmentprogress->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $recruitmentprogres = $this->Recruitmentprogress->patchEntity($recruitmentprogres, $this->request->data);
            if ($this->Recruitmentprogress->save($recruitmentprogres)) {
                $this->Flash->success(__('The recruitmentprogres has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The recruitmentprogres could not be saved. Please, try again.'));
        }
        $this->set(compact('recruitmentprogres'));
        $this->set('_serialize', ['recruitmentprogres']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Recruitmentprogres id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $recruitmentprogres = $this->Recruitmentprogress->get($id);
        if ($this->Recruitmentprogress->delete($recruitmentprogres)) {
            $this->Flash->success(__('The recruitmentprogres has been deleted.'));
        } else {
            $this->Flash->error(__('The recruitmentprogres could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
