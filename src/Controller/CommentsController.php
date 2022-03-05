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
class CommentsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);        
        $this->viewBuilder()->layout('ajax');

    }
    
    public function isAuthorized($user)
    {       
      if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to leave comments this page.'));
          return $this->redirect(['controller' => 'users', 'action' => 'login']);
      } else {
          return true;
      }
      
         return parent::isAuthorized($user);
    }
    
   
    public function comment($tutorial_id) {
     
      $this->set('tutorial_id', $tutorial_id);
    }
    
    public function reply($comment_id) {
      $this->set('comment_id', $comment_id);
    }  

    public function delete($comment_id) {
      $this->set('comment_id', $comment_id);
    }
    
    
    public function deleteaction()
    {
            
      $this->autoRender = false;
      $user_id = $this->Auth->user('id');
      
      $this->request->allowMethod(['post', 'delete']);
      
      $ids = $this->request->data['comment_id'];
      $explode = explode('-', $ids);
      $tutorial_id = $explode['1'];
      $comment_id = $explode['0'];
      
      $this->loadModel('TutorialComments');
    
      $comments = $this->TutorialComments->find('all',['conditions'=>['OR' => ['TutorialComments.id' => $comment_id, 'TutorialComments.parent_id' => $comment_id], 'TutorialComments.user_id' => $user_id], 'fields' => ['TutorialComments.id']]);

      $ids = '';
      foreach($comments as $comment){
      $ids .= $comment->id.',';
      }
      
      $ids = rtrim($ids, ','); 

        if ($this->TutorialComments->deleteAll(['id IN ('.$ids.')'])) {
        
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'tutorials', 'action' => 'index']);

    }
    
    
    public function commentaction() { 

      $user_id = $this->Auth->user('id');
            
      $this->autoRender = false;
      $user_id = $this->Auth->user('id');
      $this->loadModel('TutorialComments');
      $comments = $this->TutorialComments->newEntity();
      if ($this->request->is('post')) {
        
        $comments = $this->TutorialComments->patchEntity($comments, $this->request->data);
        $comments->user_id = $user_id;
        $comments->is_parent = 1;
        $comments->parent_id = 0;
        $comments->approved = 1;
        $comments->username = $this->Auth->user('name');
        $comments->userslug = $this->Auth->user('slug');
        if($this->Auth->user('avatar')) { $comments->useravatar = $this->Auth->user('avatar'); }
        $comments->created =  date("Y-m-d H:i:s");
        $comments->modified =  date("Y-m-d H:i:s");
        
        if ($this->TutorialComments->save($comments)) {
            $this->Flash->success(__('The comment has been saved.'));
            return $this->redirect(['controller' => 'tutorials', 'action' => 'index']);
        } else {
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
    }
	} 
  
  
      public function replyaction() { 

      $user_id = $this->Auth->user('id');     
      $this->autoRender = false;

      $this->loadModel('TutorialComments');
      $comments = $this->TutorialComments->newEntity();
      if ($this->request->is('post')) {
      
      $ids = $this->request->data['comment_id'];
      $explode = explode('-', $ids);
      $tutorial_id = $explode['1'];
      $parent_id = $explode['0'];

        
        $comments = $this->TutorialComments->patchEntity($comments, $this->request->data);
        $comments->user_id = $this->Auth->user('id');
        $comments->is_parent = 0;
        $comments->is_child = 1;
        $comments->parent_id = $parent_id;
        $comments->tutorial_id = $tutorial_id;
        $comments->approved = 1;
        $comments->username = $this->Auth->user('name');
        $comments->userslug = $this->Auth->user('slug');
        if($this->Auth->user('avatar')) { $comments->useravatar = $this->Auth->user('avatar'); }
        $comments->created =  date("Y-m-d H:i:s");
        $comments->modified =  date("Y-m-d H:i:s");
        
        if ($this->TutorialComments->save($comments)) {
            $this->Flash->success(__('The comment has been saved.'));
            return $this->redirect(['controller' => 'tutorials', 'action' => 'index']);
        } else {
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
    }
	}   
 
}