<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserArticles Controller
 *
 * @property \Candidates\Model\Table\UserArticlesTable $UserArticles
 */
class UserArticlesController extends AppController
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
        $this->paginate = [
            'contain' => ['Users', 'UserArticleCategories']
        ];
        $userArticles = $this->paginate($this->UserArticles);

        $this->set(compact('userArticles'));
        $this->set('_serialize', ['userArticles']);
    }

    /**
     * View method
     *
     * @param string|null $id User Article id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userArticle = $this->UserArticles->get($id, [
            'contain' => ['Users', 'UserArticleCategories', 'Images']
        ]);

        $this->set('userArticle', $userArticle);
        $this->set('_serialize', ['userArticle']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userArticle = $this->UserArticles->newEntity();
        if ($this->request->is('post')) {
            $userArticle = $this->UserArticles->patchEntity($userArticle, $this->request->data);
            if ($this->UserArticles->save($userArticle)) {
                $this->Flash->success(__('The user article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user article could not be saved. Please, try again.'));
        }
        $users = $this->UserArticles->Users->find('list', ['limit' => 200]);
        $userArticleCategories = $this->UserArticles->UserArticleCategories->find('list', ['limit' => 200]);
        $images = $this->UserArticles->Images->find('list', ['limit' => 200]);
        $this->set(compact('userArticle', 'users', 'userArticleCategories', 'images'));
        $this->set('_serialize', ['userArticle']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Article id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userArticle = $this->UserArticles->get($id, [
            'contain' => ['Images']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userArticle = $this->UserArticles->patchEntity($userArticle, $this->request->data);
            if ($this->UserArticles->save($userArticle)) {
                $this->Flash->success(__('The user article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user article could not be saved. Please, try again.'));
        }
        $users = $this->UserArticles->Users->find('list', ['limit' => 200]);
        $userArticleCategories = $this->UserArticles->UserArticleCategories->find('list', ['limit' => 200]);
        $images = $this->UserArticles->Images->find('list', ['limit' => 200]);
        $this->set(compact('userArticle', 'users', 'userArticleCategories', 'images'));
        $this->set('_serialize', ['userArticle']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userArticle = $this->UserArticles->get($id);
        if ($this->UserArticles->delete($userArticle)) {
            $this->Flash->success(__('The user article has been deleted.'));
        } else {
            $this->Flash->error(__('The user article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
