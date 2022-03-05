<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * TutorialComments Controller
 *
 * @property \Manager\Model\Table\TutorialCommentsTable $TutorialComments
 */
class TutorialCommentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'tutorials');  
        
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
            'contain' => ['ParentTutorialComments', 'Users', 'Tutorials']
        ];
        $tutorialComments = $this->paginate($this->TutorialComments);

        $this->set(compact('tutorialComments'));
        $this->set('_serialize', ['tutorialComments']);
    }

    /**
     * View method
     *
     * @param string|null $id Tutorial Comment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tutorialComment = $this->TutorialComments->get($id, [
            'contain' => ['ParentTutorialComments', 'Users', 'Tutorials', 'ChildTutorialComments']
        ]);

        $this->set('tutorialComment', $tutorialComment);
        $this->set('_serialize', ['tutorialComment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tutorialComment = $this->TutorialComments->newEntity();
        if ($this->request->is('post')) {
            $tutorialComment = $this->TutorialComments->patchEntity($tutorialComment, $this->request->data);
            if ($this->TutorialComments->save($tutorialComment)) {
                $this->Flash->success(__('The tutorial comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial comment could not be saved. Please, try again.'));
        }
        $parentTutorialComments = $this->TutorialComments->ParentTutorialComments->find('list', ['limit' => 200]);
        $users = $this->TutorialComments->Users->find('list', ['limit' => 200]);
        $tutorials = $this->TutorialComments->Tutorials->find('list', ['limit' => 200]);
        $this->set(compact('tutorialComment', 'parentTutorialComments', 'users', 'tutorials'));
        $this->set('_serialize', ['tutorialComment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tutorial Comment id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tutorialComment = $this->TutorialComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tutorialComment = $this->TutorialComments->patchEntity($tutorialComment, $this->request->data);
            if ($this->TutorialComments->save($tutorialComment)) {
                $this->Flash->success(__('The tutorial comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial comment could not be saved. Please, try again.'));
        }
        $parentTutorialComments = $this->TutorialComments->ParentTutorialComments->find('list', ['limit' => 200]);
        $users = $this->TutorialComments->Users->find('list', ['limit' => 200]);
        $tutorials = $this->TutorialComments->Tutorials->find('list', ['limit' => 200]);
        $this->set(compact('tutorialComment', 'parentTutorialComments', 'users', 'tutorials'));
        $this->set('_serialize', ['tutorialComment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tutorial Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tutorialComment = $this->TutorialComments->get($id);
        if ($this->TutorialComments->delete($tutorialComment)) {
            $this->Flash->success(__('The tutorial comment has been deleted.'));
        } else {
            $this->Flash->error(__('The tutorial comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
