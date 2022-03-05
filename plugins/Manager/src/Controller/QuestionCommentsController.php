<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * QuestionComments Controller
 *
 * @property \Qanda\Model\Table\QuestionCommentsTable $QuestionComments
 */
class QuestionCommentsController extends AppController
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
            'contain' => ['Users', 'Questions']
        ];
        $questionComments = $this->paginate($this->QuestionComments);

        $this->set(compact('questionComments'));
        $this->set('_serialize', ['questionComments']);
    }

    /**
     * View method
     *
     * @param string|null $id Question Comment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionComment = $this->QuestionComments->get($id, [
            'contain' => ['Users', 'Questions']
        ]);

        $this->set('questionComment', $questionComment);
        $this->set('_serialize', ['questionComment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionComment = $this->QuestionComments->newEntity();
        if ($this->request->is('post')) {
            $questionComment = $this->QuestionComments->patchEntity($questionComment, $this->request->data);
            if ($this->QuestionComments->save($questionComment)) {
                $this->Flash->success(__('The question comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question comment could not be saved. Please, try again.'));
        }
        $users = $this->QuestionComments->Users->find('list', ['limit' => 200]);
        $questions = $this->QuestionComments->Questions->find('list', ['limit' => 200]);
        $this->set(compact('questionComment', 'users', 'questions'));
        $this->set('_serialize', ['questionComment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Question Comment id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionComment = $this->QuestionComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionComment = $this->QuestionComments->patchEntity($questionComment, $this->request->data);
            if ($this->QuestionComments->save($questionComment)) {
                $this->Flash->success(__('The question comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question comment could not be saved. Please, try again.'));
        }
        $users = $this->QuestionComments->Users->find('list', ['limit' => 200]);
        $questions = $this->QuestionComments->Questions->find('list', ['limit' => 200]);
        $this->set(compact('questionComment', 'users', 'questions'));
        $this->set('_serialize', ['questionComment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionComment = $this->QuestionComments->get($id);
        if ($this->QuestionComments->delete($questionComment)) {
            $this->Flash->success(__('The question comment has been deleted.'));
        } else {
            $this->Flash->error(__('The question comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
