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
class EmploymentController extends AppController
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

    public function add(){
      
      
                                                                                                                          
    }    
    
    public function index(){
      $this->viewBuilder()->layout('frontside');
      $user_id = $this->Auth->user('id');
      $this->loadModel('UserEmployments');
      $employments = $this->UserEmployments->find('all',['conditions'=>['UserEmployments.user_id'=>$user_id],'order'=>['UserEmployments.rank' => 'ASC']]);                                                                                                                     
      $this->set('employments', $employments); 
    }
    
    public function addaction() {
          
          $this->autoRender = false;
          $user_id = $this->Auth->user('id');
          $this->loadModel('UserEmployments');
          $employment = $this->UserEmployments->newEntity();
          if ($this->request->is('post')) {
            $employment = $this->UserEmployments->patchEntity($employment, $this->request->data);
            $employment->created = date('Y-m-d');
            $employment->modified = date('Y-m-d');
            $employment->user_id = $user_id;
            if ($this->UserEmployments->save($employment)) {
                $this->Flash->success(__('The employment detail has been saved.'));
                return $this->redirect(['controller' => 'employment', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The employment detail could not be saved. Please, try again.'));
            }
        }    
    }

   public function edit($employmentid){
        
      $user_id = $this->Auth->user('id');
      $this->loadModel('UserEmployments'); 


      $employment = $this->UserEmployments->find('all', [ 
        'conditions' => ['user_id' => $user_id, 'id' => $employmentid]
      ]);
      $employment = $employment->first();

               
      $this->set('employment', $employment); 
                                                                                                                          
    }
    
    public function editaction($id) {
          
          $this->autoRender = false;
          if ($this->request->is(['patch', 'post', 'put'])) {
          
            $user_id = $this->Auth->user('id');
            $this->loadModel('UserEmployments');
            $employment = $this->UserEmployments->find('all', [ 
              'conditions' => ['user_id' => $user_id, 'id' => $id]
            ]);
            $employment = $employment->first();

            $employment = $this->UserEmployments->patchEntity($employment, $this->request->data);
            $employment->modified = date('Y-m-d');
            if ($this->UserEmployments->save($employment)) {
                $this->Flash->success(__('The employment detail has been saved.'));
                return $this->redirect(['controller' => 'employment', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The employment detail could not be saved. Please, try again.'));
            }
        }
    
    }

   
    public function sort(){

      $user_id = $this->Auth->user('id');
  		$this->loadModel('UserEmployments');
      $employments = $this->UserEmployments->find('all',['conditions'=>['UserEmployments.user_id'=>$user_id],'order'=>['UserEmployments.rank' => 'ASC']]); 
  		$this->set('EH',$employments);
           
      //$this->Session->write('my_profile', 'employment');
    }

    public function sortaction(){
      
      $this->autoRender = false;
      $user_id = $this->Auth->user('id');

      if ($this->request->is(['patch', 'post', 'put'])) {
      
        $this->loadModel('UserEmployments');
        $this->UserEmployments->updateAll(['displayme' => 0,'rank' => 0], ['UserEmployment.user_id' => $user_id]);
        
        $saved = 0;      
        
        $displayme = $this->request->data['displayme'];
        foreach($displayme as $k => $id) {
        
          $Table = TableRegistry::get('UserEmployments');
          $employment = $Table->get($id);
          
          $employment->displayme = 1;
          
          if ($Table->save($employment)) {
            $saved = 1;
          }
        
        }
        
        $rankme = $this->request->data['id'];
        foreach($rankme as $k => $id) {
        
          $Table = TableRegistry::get('UserEmployments');
          $employment = $Table->get($id);
          
          $employment->rank = $k + 1;
          
          if ($Table->save($employment)) {
            $saved = 1;
          }
        
        }
        
              if($saved == 1) {
              $this->Flash->success(__('Employments has been sorted.'));
              return $this->redirect(['controller' => 'employment', 'action' => 'index']);
            }
            
        }
      }
      
      public function deleteemployment($id)
    {
    
        if(is_null($this->Auth->user('id'))){
              $this->Flash->success(__('Please login to access this page.'));
              return $this->redirect(['controller' => 'users', 'action' => 'loginmodal']);
        } else {
             $user_id = $this->Auth->user('id');
        } 
    
        $this->request->allowMethod(['post', 'delete']);
        
        $this->loadModel('UserEmployments');
        $employment = $this->UserEmployments->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $employment = $employment->first();
        
        if ($this->UserEmployments->delete($employment)) {
            $this->Flash->success(__('The employment has been deleted.'));
        } else {
            $this->Flash->error(__('The employment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['plugin'=>null, 'controller'=>'employment', 'action' => 'index']);
    }

}