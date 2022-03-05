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
class QualificationController extends AppController
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
      $this->loadModel('UserQualifications');
      $qualifications = $this->UserQualifications->find('all',['conditions'=>['UserQualifications.user_id'=>$user_id],'order'=>['UserQualifications.rank' => 'ASC']]);                                                                                                                     
      $this->set('qualifications', $qualifications); 
    } 
    
    public function add(){
      $country_id = $this->Auth->user('country_id');
      $this->set('country_id', $country_id);
      $this->loadModel('Countries');
      $countries = $this->Countries->find('list');
      $this->set('countries', $countries);                                                                                                                    
    }
    
    public function addaction() {
          
          $this->autoRender = false;
          $user_id = $this->Auth->user('id');
          $this->loadModel('UserQualifications');
          $qualification = $this->UserQualifications->newEntity();
          if ($this->request->is('post')) {
            $qualification = $this->UserQualifications->patchEntity($qualification, $this->request->data);
            $qualification->created = date('Y-m-d');
            $qualification->modified = date('Y-m-d');
            $qualification->user_id = $user_id;
            if ($this->UserQualifications->save($qualification)) {
                $this->Flash->success(__('The qualification detail has been saved.'));
                return $this->redirect(['controller' => 'qualification', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The qualification detail could not be saved. Please, try again.'));
            }
        }    
    }

   public function edit($qualificationid) {     
    
      $user_id = $this->Auth->user('id');
      $this->loadModel('UserQualifications'); 

      $qualification = $this->UserQualifications->find('all', [ 
        'conditions' => ['user_id' => $user_id, 'id' => $qualificationid]
      ]);
      $qualification = $qualification->first();
               
      $this->set('qualification', $qualification);
      
      $this->loadModel('Countries');
      $countries = $this->Countries->find('list');
      $this->set('countries', $countries);  
                                                                                                                          
    }
    
    public function editaction($id) {
          
          $this->autoRender = false;
          if ($this->request->is(['patch', 'post', 'put'])) {
          
            $this->loadModel('UserQualifications');

            $user_id = $this->Auth->user('id');
            $qualification = $this->UserQualifications->find('all', [ 
            'conditions' => ['user_id' => $user_id, 'id' => $id]
            ]);
            $qualification = $qualification->first();
            
            $qualification = $this->UserQualifications->patchEntity($qualification, $this->request->data);
            $qualification->modified = date('Y-m-d');
            
            if ($this->UserQualifications->save($qualification)) {
                $this->Flash->success(__('The qualification detail has been saved.'));
                return $this->redirect(['controller' => 'qualification', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The qualification detail could not be saved. Please, try again.'));
            }
        }
    
    }

   
    public function sort(){
      
      $user_id = $this->Auth->user('id');
  		$this->loadModel('UserQualifications');
      $qualifications = $this->UserQualifications->find('all',['conditions'=>['UserQualifications.user_id'=>$user_id],'order'=>'UserQualifications.rank ASC']); 
  	
      $this->set('QA',$qualifications);
           
      //$this->Session->write('my_profile', 'qualification');
    }

    public function sortaction(){
      
      $this->autoRender = false;
      $user_id = $this->Auth->user('id');

      if ($this->request->is(['patch', 'post', 'put'])) {
      
          $this->loadModel('UserQualifications');
          $this->UserQualifications->updateAll(['displayme' => 0,'rank' => 0], ['UserEmployment.user_id' => $user_id]);
          
          $saved = 0;      
        
          $displayme = $this->request->data['displayme'];
          foreach($displayme as $k => $id) {
          
            $Table = TableRegistry::get('UserQualifications');
            $qualification = $Table->get($id);
            
            $qualification->displayme = 1;
            
            if ($Table->save($qualification)) {
              $saved = 1;
            }
          
          }
        
            $rankme = $this->request->data['id'];
            foreach($rankme as $k => $id) {
            
              $Table = TableRegistry::get('UserQualifications');
              $qualification = $Table->get($id);
              
              $qualification->rank = $k + 1;
              
              if ($Table->save($qualification)) {
                $saved = 1;
              }
            
            }
        
              if($saved == 1) {
              $this->Flash->success(__('Qualifications has been sorted.'));
              return $this->redirect(['controller' => 'qualification', 'action' => 'index']);
            }
            
        }
      }
      
            public function deletequalification($id)
    {
    
        if(is_null($this->Auth->user('id'))){
              $this->Flash->success(__('Please login to access this page.'));
              return $this->redirect(['controller' => 'users', 'action' => 'loginmodal']);
        } else {
             $user_id = $this->Auth->user('id');
        } 
    
        $this->request->allowMethod(['post', 'delete']);
        
        $this->loadModel('UserQualifications');
        $qualification = $this->UserQualifications->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $qualification = $qualification->first();
        
        if ($this->UserQualifications->delete($qualification)) {
            $this->Flash->success(__('The qualification has been deleted.'));
        } else {
            $this->Flash->error(__('The qualification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['plugin'=>null, 'controller'=>'qualification', 'action' => 'index']);
    }

}