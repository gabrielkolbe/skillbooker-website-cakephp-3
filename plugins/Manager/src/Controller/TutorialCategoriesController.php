<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * TutorialCategories Controller
 *
 * @property \Manager\Model\Table\TutorialCategoriesTable $TutorialCategories
 */
class TutorialCategoriesController extends AppController
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
        $tutorialCategories = $this->paginate($this->TutorialCategories);

        $this->set(compact('tutorialCategories'));
        $this->set('_serialize', ['tutorialCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Tutorial Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tutorialCategory = $this->TutorialCategories->get($id, [
            'contain' => ['TutorialComments', 'Tutorials']
        ]);

        $this->set('tutorialCategory', $tutorialCategory);
        $this->set('_serialize', ['tutorialCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tutorialCategory = $this->TutorialCategories->newEntity();
        if ($this->request->is('post')) {
            $tutorialCategory = $this->TutorialCategories->patchEntity($tutorialCategory, $this->request->data);
            if ($this->TutorialCategories->save($tutorialCategory)) {
                $this->Flash->success(__('The tutorial category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial category could not be saved. Please, try again.'));
        }
        $this->set(compact('tutorialCategory'));
        $this->set('_serialize', ['tutorialCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tutorial Category id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tutorialCategory = $this->TutorialCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tutorialCategory = $this->TutorialCategories->patchEntity($tutorialCategory, $this->request->data);
            if ($this->TutorialCategories->save($tutorialCategory)) {
                $this->Flash->success(__('The tutorial category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial category could not be saved. Please, try again.'));
        }
        $this->set(compact('tutorialCategory'));
        $this->set('_serialize', ['tutorialCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tutorial Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tutorialCategory = $this->TutorialCategories->get($id);
        if ($this->TutorialCategories->delete($tutorialCategory)) {
            $this->Flash->success(__('The tutorial category has been deleted.'));
        } else {
            $this->Flash->error(__('The tutorial category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
