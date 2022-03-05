<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ResumesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('frontside');
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
    
    
     
	function index() {
  
    $user_id = $this->Auth->user('id');
    
    $this->loadModel('UserResumes');  
    $resumes = $this->UserResumes->find('all',[
    'conditions'=>['UserResumes.user_id'=>$user_id],
    'order'=>['UserResumes.id' =>'DESC']
    ]);
    
    $this->set('resumes', $resumes);
  
  }
  
      public function viewresume($id)
    {
        $user_id = $this->Auth->user('id');
        
        $this->loadModel('UserResumes');
        $resume = $this->UserResumes->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id],
          'order' => 'id DESC'
        ]);
        $resume = $resume->first();
        
        $this->set('resume', $resume);
    }
    
  
  public function addresume(){
  $this->viewBuilder()->layout('ajax');
  
  if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to access this page.'));
          return $this->redirect(['controller' => 'users', 'action' => 'login']);
  }
  
  $this->loadModel('Industries'); 
  $industries = $this->Industries->find('list');
  $this->set('industries', $industries);
  
  }
  
  public function addresumeaction(){
      $this->autoRender = false;
      $user_id = $this->Auth->user('id');
      
          if ($this->request->is('post')) {
          
          //debug($this->request->data);
          //die;
          
            $filename = $this->request->data['resume']['name'];
            $tempPath = $this->request->data['resume']['tmp_name'];
            $filetype = $this->request->data['resume']['type'];
            if(!empty($this->request->data['defaultresume'])) {
              $default = $this->request->data['defaultresume'];
            } else {
              $default = 0;
            }
            
            $industry_id = $this->request->data['industry_id'];
            
            $Table = TableRegistry::get('UserResumes');
            
            $this->loadComponent('Cvupload');                  
            $result = $this->Cvupload->upload_cv($user_id, $filename, $filetype, $tempPath, 'uploads/resumes/', $default, $industry_id);
            
            
                    
            if($result == 'success'){
                $this->Flash->success(__('Resume successfully uploaded.'));
                return $this->redirect(['controller' => 'resumes', 'action' => 'index']);
            }             
          } 
                                               
} 

    public function deleteresume($id)
    {    
        $user_id = $this->Auth->user('id');
    
        $this->request->allowMethod(['post', 'delete']);
        
        $this->loadModel('UserResumes');
        $resume = $this->UserResumes->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $resume = $resume->first();
        
        if ($this->UserResumes->delete($resume)) {
        $file = WWW_ROOT.'/uploads/resumes/'.$resume->newname;
        unlink($file);
            $this->Flash->success(__('The resume has been deleted.'));
        } else {
            $this->Flash->error(__('The resume could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'resumes', 'action' => 'index']);
    }                       

     public function setdefault(){
      
        $user_id = $this->Auth->user('id'); 
                
        $this->viewBuilder()->layout('ajax');
        
        $this->loadModel('UserResumes');
        $resumes = $this->UserResumes->find('all', [ 
          'conditions' => ['user_id' => $user_id],
          'order' => 'id DESC'
        ]);
        $this->set('resumes', $resumes);
        
     
     }
     
     
      public function setdefaultaction(){
      $this->autoRender = false;
      $user_id = $this->Auth->user('id');
      
        if ($this->request->is('post')) {
        
        //debug($this->request->data);
        //die;
        
        $Table = TableRegistry::get('UserResumes');
              
        $resumes = $Table->find('all', [ 
        'conditions' => ['user_id' => $user_id]
        ]);
        $resumecount = $resumes->count();
        if($resumecount > 0){
        
         $Table->updateAll(['is_default' => 0], ['user_id' => $user_id]);
        
        }
      
          $resume_id = $this->request->data['setdefault'];
          $update = $Table->get($resume_id); 
          $update->is_default = 1;
          if($Table->save($update)){          
            $this->Flash->success(__('The resume has set as default.'));
            return $this->redirect(['controller'=>'resumes', 'action' => 'index']);
          }
          
        } 
  }
  
  
  public function download($id) {
		
    $user_id = $this->Auth->user('id');
                        
    $this->loadModel('UserResumes');
    $resumes = $this->UserResumes->find('all', [ 
      'conditions' => ['user_id' => $user_id, 'id' => $id]
    ]);

    $resume = $resumes->first();
    
    if(!empty($resume)){
      $downloads = $resume->downloads + 1;    
			$this->UserResumes->updateAll(['downloads' => $downloads],['id' => $id]);
		}        
    
    $filePath = WWW_ROOT .'uploads'.DS.'resumes'. DS . $resume->newname;
    
    $this->response->file($filePath, [
    'download' => true,
    'name' => $resume->newname,
    ]);

    return $this->response;

   /*            
    return $this->response->withFile($filePath, [
    'download' => true,
    'name' => $resume->newname,
    ]);
   */ 

    //return $this->redirect(['controller'=>'resumes', 'action' => 'index']);    
	}
  
  
      public function getindustry($id = null)
    {
        $this->viewBuilder()->layout('ajax');
        
        $this->loadModel('Skills');   
        $list = $this->Skills->find('all', ['conditions' => ['Skills.industry_id' => $id]]);
        $count = $list->count();
        $this->set('countskills', $count);   
    }

}