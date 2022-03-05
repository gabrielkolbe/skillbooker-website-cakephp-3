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
class SkillsController extends AppController
{

   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('ajax');

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
    


	public function edit($id){

    $user_id = $this->Auth->user('id');
    $this->loadModel('UserSkills');
    $query = $this->UserSkills->find('all',['conditions'=>['UserSkills.user_id'=>$user_id, 'UserSkills.id'=>$id]]);    
    $skill = $query->first();
    $this->set('skill',$skill);
	}
  
  	public function editaction(){
           
          $this->autoRender = false;
          if ($this->request->is(['patch', 'post', 'put'])) {
          
            $id = $this->request->data['id'];
            $Table = TableRegistry::get('UserSkills');
            $skill = $Table->get($id);
            
            $skill->level = $this->request->data['level'];
  
            if ($Table->save($skill)) {
                $this->Flash->success(__('The Skill has been saved.'));
                return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The skill could not be saved. Please, try again.'));
            }
        }
	}
  
  public function add(){

    $user_id = $this->Auth->user('id');
    
    $this->loadModel('Users');
    $query = $this->Users->find('all',['conditions'=>['Users.id'=>$user_id]]);    
    $user = $query->first();
     
    $industry_id = $user->industry_id;
    $display_industry = $user->display_industry;
    $this->set('display_industry',$display_industry);
    
    if(!empty($industry_id)) { 

          $this->loadModel('Skills');
          $skills = $this->Skills
            ->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where(['industry_id' => $industry_id])
            ->toArray();
    }
    
    
    $this->set('skills',$skills);
            
          $this->loadModel('UserSkills');
          $userskills = $this->UserSkills
            ->find('list', ['keyField' => 'skill_id', 'valueField' => 'skill_name'])
            ->where(['user_id' => $user_id])
            ->toArray();
            
    $this->set('userskills',$userskills);
	
	}
   

    public function addaction() {
          
    $this->autoRender = false;
    $user_id = $this->Auth->user('id');

    
    if ($this->request->is('post')) {
    $saved = 0; 
         
      if($this->request->data['skill_id'] <> ''){
      
        $this->loadModel('UserSkills');
        $this->UserSkills->deleteAll(['user_id' => $user_id]);
        
        $skills	=	$this->request->data['skill_id'];
        
        foreach($skills as $key=>$skillid){
        
          $this->loadModel('Skills');
          $query = $this->Skills->find('all',['conditions'=>['id'=>$skillid]]);
          $skill = $query->first();
          
          if(!empty($skill)){
                   
            $Table = TableRegistry::get('UserSkills');
            $insert = $Table->newEntity();
            
            $insert->user_id = $user_id;
            $insert->skill_id = $skill->id;
            $insert->skill_name = $skill->name;
            $insert->slug = strtolower($skill->name);

            if ($Table->save($insert)) {
               $saved = 1; 
            }
          
          }
        }
      }
 
      if($this->request->data['skill_name'] <> ''){
      $newkeywords = $this->request->data['skill_name'];

                $keys = explode(',', $newkeywords);
                foreach($keys as $kkeys => $vkey){
                        
                  $this->loadModel('UserSkills');
                  $keyquery = $this->UserSkills->find('all',['conditions'=>['skill_name' => $vkey]]);
                  $keyw = $keyquery->first(); 
                  
                        if($keyw == null){
                        
                          $Tablen = TableRegistry::get('UserSkills');
                          $insertnew = $Tablen->newEntity();
                          
                          $insertnew->user_id = $user_id;
                          $insertnew->skill_id = '999999999';
                          $insertnew->skill_name = $vkey;
                          $insertnew->slug = strtolower($vkey);
                          $insertnew->level = 2;
                    
                          if ($Tablen->save($insertnew)) {
                             $saved = 1; 
                          }
                                  
                        } 
                               
                 }
  
        }
            if($saved == 1) {
              $this->Flash->success(__('The Skill has been saved.'));
              return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            }
          }  // close post
        
    }    // close function
    
    
  public function rate(){
	     
    $user_id = $this->Auth->user('id');
    
    $this->loadModel('UserSkills');
    $skills = $this->UserSkills->find('all',['conditions'=>['UserSkills.user_id'=>$user_id]]);  
    $this->set('skills',$skills);

	}
  
    public function rateaction(){
	     
    $this->autoRender = false;
    $user_id = $this->Auth->user('id');
    
    if ($this->request->is('post')) {
    $saved = 0; 
         
      if($this->request->data['rating'] <> ''){
      
        $skills	=	$this->request->data['rating'];
        
        foreach($skills as $id=>$level){
        
          $this->loadModel('UserSkills');
          $query = $this->UserSkills->find('all',['conditions'=>['id'=>$id, 'user_id'=>$user_id]]);
          $skill = $query->first();
          
          if(!empty($skill)){
                   
            $Table = TableRegistry::get('UserSkills');
            $update = $Table->get($id);
            
            $update->level =$level;

            if ($Table->save($update)) {
               $saved = 1; 
            }
          
          }
        }
      }
          $this->Flash->success(__('The Skills has been updated.'));
          return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
	}     
}


      public function deleteskill($id)
    {
    
        if(is_null($this->Auth->user('id'))){
              $this->Flash->success(__('Please login to access this page.'));
              return $this->redirect(['controller' => 'users', 'action' => 'loginmodal']);
        } else {
             $user_id = $this->Auth->user('id');
        } 
    
        $this->request->allowMethod(['post', 'delete']);
        
        $this->loadModel('UserSkills');
        $skill = $this->UserSkills->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $skill = $skill->first();
        
        if ($this->UserSkills->delete($skill)) {
            $this->Flash->success(__('The skill has been deleted.'));
        } else {
            $this->Flash->error(__('The skill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['plugin'=>null, 'controller'=>'portfolio', 'action' => 'index']);
    }
    
    
}