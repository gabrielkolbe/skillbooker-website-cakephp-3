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
class PublicationController extends AppController
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
      $this->loadModel('UserPublications');
      $publications = $this->UserPublications->find('all',['conditions'=>['UserPublications.user_id'=>$user_id],'order'=>['UserPublications.rank' => 'ASC']]);                                                                                                                     
      $this->set('publications', $publications); 
    }
    
    
    public function add(){
                                                                                                                  
    }
    
    public function addaction() {
          
          $this->autoRender = false;
          $user_id = $this->Auth->user('id');
          $this->loadModel('UserPublications');
          $publication = $this->UserPublications->newEntity();
          if ($this->request->is('post')) {
            $publication = $this->UserPublications->patchEntity($publication, $this->request->data);
            $publication->created = date('Y-m-d');
            $publication->modified = date('Y-m-d');
            $publication->user_id = $user_id;
            if ($this->UserPublications->save($publication)) {
                $this->Flash->success(__('The publication detail has been saved.'));
                return $this->redirect(['controller' => 'publication', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The publication detail could not be saved. Please, try again.'));
            }
        }    
    }

   public function edit($id) {
    
      $user_id = $this->Auth->user('id');
      $this->loadModel('UserPublications'); 

      $publication = $this->UserPublications->find('all', [ 
      'conditions' => ['user_id' => $user_id, 'id' => $id]
      ]);
      $publication = $publication->first();
               
      $this->set('publication', $publication); 
                                                                                                                          
    }
    
    public function editaction($id) {
          
          $this->autoRender = false;
          if ($this->request->is(['patch', 'post', 'put'])) {
          
            $this->loadModel('UserPublications');
            
            $user_id = $this->Auth->user('id');
            $publication = $this->UserPublications->find('all', [ 
            'conditions' => ['user_id' => $user_id, 'id' => $id]
            ]);
            $publication = $publication->first();
  
            $publication = $this->UserPublications->patchEntity($publication, $this->request->data);
            $publication->modified = date('Y-m-d');
            if ($this->UserPublications->save($publication)) {
                $this->Flash->success(__('The publication detail has been saved.'));
                return $this->redirect(['controller' => 'publication', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The publication detail could not be saved. Please, try again.'));
            }
        }
    
    }

   
    public function sort(){
      
      $user_id = $this->Auth->user('id');
  		$this->loadModel('UserPublications');
      $publications = $this->UserPublications->find('all',['conditions'=>['UserPublications.user_id'=>$user_id],'order'=>'UserPublications.rank ASC']); 
  	
      $this->set('result',$publications);
           
      //$this->Session->write('my_profile', 'publication');
    }

    public function sortaction(){
      
      $this->autoRender = false;
      $user_id = $this->Auth->user('id');

      if ($this->request->is(['patch', 'post', 'put'])) {
      
          $this->loadModel('UserPublications');
          $this->UserPublications->updateAll(['displayme' => 0,'rank' => 0], ['UserEmployment.user_id' => $user_id]);
          
          $saved = 0;      
        
          $displayme = $this->request->data['displayme'];
          foreach($displayme as $k => $id) {
          
            $Table = TableRegistry::get('UserPublications');
            $publication = $Table->get($id);
            
            $publication->displayme = 1;
            
            if ($Table->save($publication)) {
              $saved = 1;
            }
          
          }
        
            $rankme = $this->request->data['id'];
            foreach($rankme as $k => $id) {
            
              $Table = TableRegistry::get('UserPublications');
              $publication = $Table->get($id);
              
              $publication->rank = $k + 1;
              
              if ($Table->save($publication)) {
                $saved = 1;
              }
            
            }
        
            if($saved == 1) {
              $this->Flash->success(__('Publications has been sorted.'));
              return $this->redirect(['controller' => 'publication', 'action' => 'index']);
            }
            
        }
      }
      
      public function deletepublication($id)
    {
    
        if(is_null($this->Auth->user('id'))){
              $this->Flash->success(__('Please login to access this page.'));
              return $this->redirect(['controller' => 'users', 'action' => 'loginmodal']);
        } else {
             $user_id = $this->Auth->user('id');
        } 
    
        $this->request->allowMethod(['post', 'delete']);
        
        $this->loadModel('UserPublications');
        $publication = $this->UserPublications->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $publication = $publication->first();
        
        if ($this->UserPublications->delete($publication)) {
            $this->Flash->success(__('The publication has been deleted.'));
        } else {
            $this->Flash->error(__('The publication could not be deleted. Please, try again.'));
        }

        return $this->redirect(['plugin'=>null, 'controller'=>'publication', 'action' => 'index']);
    }


}