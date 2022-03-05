<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ArticleController extends AppController
{

   
   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('ajax');
        $this->set('setstate', 'portfolio');
    }
    
    public function isAuthorized($user)
    {
    
      if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to access this page.'));
          return $this->redirect(['controller' => 'users', 'action' => 'login']);
      } else {
          return true;
      }
         return parent::isAuthorized($user);
    }
    
    
    public function index(){
      $this->viewBuilder()->layout('frontside');
      $user_id = $this->Auth->user('id');
      $this->loadModel('UserArticles');
      $articles = $this->UserArticles->find('all',['conditions'=>['UserArticles.user_id'=>$user_id],'order'=>['UserArticles.rank' => 'ASC']]);                                                                                                                     
      $this->set('articles', $articles); 
    }
    
    
    public function add(){
                                                                                                                 
    }
    
    public function addaction() {
          
          $this->autoRender = false;
          $user_id = $this->Auth->user('id');
          $this->loadModel('UserArticles');
          $article = $this->UserArticles->newEntity();
          if ($this->request->is('post')) {
            $article = $this->UserArticles->patchEntity($article, $this->request->data);
            $article->created = date('Y-m-d');
            $article->modified = date('Y-m-d');
            $article->user_id = $user_id;
            if ($this->UserArticles->save($article)) {
                $this->Flash->success(__('The article detail has been saved.'));
                return $this->redirect(['controller' => 'article', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The article detail could not be saved. Please, try again.'));
            }
        }    
    }

   public function edit($id) {
    
      $user_id = $this->Auth->user('id');
      $this->loadModel('UserArticles'); 

      $article = $this->UserArticles->find('all', [ 
      'conditions' => ['user_id' => $user_id, 'id' => $id]
      ]);
      $article = $article->first();
                     
      $this->set('article', $article); 
                                                                                                                          
    }
    
    public function editaction($id) {
          
          $this->autoRender = false;
          if ($this->request->is(['patch', 'post', 'put'])) {
          
            $this->loadModel('UserArticles');
            
            $user_id = $this->Auth->user('id');
            $article = $this->UserArticles->find('all', [ 
            'conditions' => ['user_id' => $user_id, 'id' => $id]
            ]);
            $article = $article->first();
  
            $article = $this->UserArticles->patchEntity($article, $this->request->data);
            $article->modified = date('Y-m-d');

            if ($this->UserArticles->save($article)) {
                $this->Flash->success(__('The article detail has been saved.'));
                return $this->redirect(['controller' => 'article', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The article detail could not be saved. Please, try again.'));
            }
        }
    
    }

   
    public function sort(){
      
      $user_id = $this->Auth->user('id');
  		$this->loadModel('UserArticles');
      $articles = $this->UserArticles->find('all',['conditions'=>['UserArticles.user_id'=>$user_id],'order'=>'UserArticles.rank ASC']); 
  	
      $this->set('result',$articles);
           
      //$this->Session->write('my_profile', 'article');
    }

    public function sortaction(){
      
      $this->autoRender = false;
      $user_id = $this->Auth->user('id');

      if ($this->request->is(['patch', 'post', 'put'])) {
      
          $this->loadModel('UserArticles');
          $this->UserArticles->updateAll(['displayme' => 0,'rank' => 0], ['UserEmployment.user_id' => $user_id]);
          
          $saved = 0;      
        
          $displayme = $this->request->data['displayme'];
          foreach($displayme as $k => $id) {
          
            $Table = TableRegistry::get('UserArticles');
            $article = $Table->get($id);
            
            $article->displayme = 1;
            
            if ($Table->save($article)) {
              $saved = 1;
            }
          
          }
        
            $rankme = $this->request->data['id'];
            foreach($rankme as $k => $id) {
            
              $Table = TableRegistry::get('UserArticles');
              $article = $Table->get($id);
              
              $article->rank = $k + 1;
              
              if ($Table->save($article)) {
                $saved = 1;
              }
            
            }
        
            if($saved == 1) {
              $this->Flash->success(__('Articles has been sorted.'));
              return $this->redirect(['controller' => 'article', 'action' => 'index']);
            }
            
        }
      }


      public function deletearticle($id)
    {
    
        if(is_null($this->Auth->user('id'))){
              $this->Flash->success(__('Please login to access this page.'));
              return $this->redirect(['controller' => 'users', 'action' => 'loginmodal']);
        } else {
             $user_id = $this->Auth->user('id');
        } 
    
        $this->request->allowMethod(['post', 'delete']);
        
        $this->loadModel('UserArticles');
        $article = $this->UserArticles->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $article = $article->first();
        
        if ($this->UserArticles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['plugin'=>null, 'controller'=>'article', 'action' => 'index']);
    }


}