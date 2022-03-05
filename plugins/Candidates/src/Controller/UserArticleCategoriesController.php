<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserArticleCategories Controller
 *
 * @property \Candidates\Model\Table\UserArticleCategoriesTable $UserArticleCategories
 */
class UserArticleCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'candidates');  
        
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
        $userArticleCategories = $this->paginate($this->UserArticleCategories);

        $this->set(compact('userArticleCategories'));
        $this->set('_serialize', ['userArticleCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id User Article Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userArticleCategory = $this->UserArticleCategories->get($id, [
            'contain' => ['UserArticles']
        ]);

        $this->set('userArticleCategory', $userArticleCategory);
        $this->set('_serialize', ['userArticleCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userArticleCategory = $this->UserArticleCategories->newEntity();
        if ($this->request->is('post')) {
            $userArticleCategory = $this->UserArticleCategories->patchEntity($userArticleCategory, $this->request->data);
            if ($this->UserArticleCategories->save($userArticleCategory)) {
                $this->Flash->success(__('The user article category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user article category could not be saved. Please, try again.'));
        }
        $this->set(compact('userArticleCategory'));
        $this->set('_serialize', ['userArticleCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Article Category id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userArticleCategory = $this->UserArticleCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userArticleCategory = $this->UserArticleCategories->patchEntity($userArticleCategory, $this->request->data);
            if ($this->UserArticleCategories->save($userArticleCategory)) {
                $this->Flash->success(__('The user article category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user article category could not be saved. Please, try again.'));
        }
        $this->set(compact('userArticleCategory'));
        $this->set('_serialize', ['userArticleCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Article Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userArticleCategory = $this->UserArticleCategories->get($id);
        if ($this->UserArticleCategories->delete($userArticleCategory)) {
            $this->Flash->success(__('The user article category has been deleted.'));
        } else {
            $this->Flash->error(__('The user article category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
