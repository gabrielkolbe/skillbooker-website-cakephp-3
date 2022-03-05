<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class TutorialsController extends AppController
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
        $this->paginate = [
            'contain' => ['TutorialCategories']
        ];

        $this->paginate['order'] = ['Tutorials.created' => 'DESC'];
        $tutorials = $this->paginate($this->Tutorials);

        $this->set(compact('tutorials'));
        $this->set('_serialize', ['tutorials']);
    }

    /**
     * View method
     *
     * @param string|null $id Tutorial id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tutorial = $this->Tutorials->get($id, [
            'contain' => ['TutorialCategories', 'TutorialComments', 'TutorialImages', 'TutorialSkills']
        ]);

        $this->set('tutorial', $tutorial);
        $this->set('_serialize', ['tutorial']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tutorial = $this->Tutorials->newEntity();
        if ($this->request->is('post')) {
            $tutorial = $this->Tutorials->patchEntity($tutorial, $this->request->data);
                                             
              $tutorial->status = 1;
              $tutorial->twittercount = 0;
              $tutorial->hitcount = 0;
              
              $this->loadComponent('slugcreator');
              $tutorial->slug = $this->slugcreator->userslug($tutorial->name);
              
            if ($this->Tutorials->save($tutorial)) {
                $this->Flash->success(__('The tutorial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial could not be saved. Please, try again.'));
        }
        $tutorialCategories = $this->Tutorials->TutorialCategories->find('list', ['limit' => 200]);
        $this->set(compact('tutorial', 'tutorialCategories'));
        $this->set('_serialize', ['tutorial']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tutorial id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tutorial = $this->Tutorials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tutorial = $this->Tutorials->patchEntity($tutorial, $this->request->data);

            if ($this->Tutorials->save($tutorial)) {
                $this->Flash->success(__('The tutorial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial could not be saved. Please, try again.'));
        }
        $tutorialCategories = $this->Tutorials->TutorialCategories->find('list', ['limit' => 200]);
        $this->set(compact('tutorial', 'tutorialCategories'));
        $this->set('_serialize', ['tutorial']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tutorial id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tutorial = $this->Tutorials->get($id);
        if ($this->Tutorials->delete($tutorial)) {
            $this->Flash->success(__('The tutorial has been deleted.'));
        } else {
            $this->Flash->error(__('The tutorial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    public function skills($id)
    {
        if ($this->request->is('post')) {

        if ($this->request->data['skillselect'] == 'drop'){
            if(isset($this->request->data['drop_skill_id'])) {
                $skill_ids = $this->request->data['drop_skill_id'];
                $this->skillsaction($id, $skill_ids);
            }
            
           
           } elseif($this->request->data['skillselect'] == 'list') {
           
            if(isset($this->request->data['list_skill_id'])) {
                $skill_ids = $this->request->data['list_skill_id'];
                $this->skillsaction($id, $skill_ids);
            }
            
            
           } else {
             echo 'oops';
           }
        }
        
        
        $tutorial = $this->Tutorials->get($id);
          
          $this->loadModel('Skills');
          $skills = $this->Skills
            ->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where(['industry_id' => $tutorial->industry_id])
            ->toArray();
            
          $this->loadModel('Industries');
          $industries = $this->Industries
            ->find()
            ->where(['id' =>  $tutorial->industry_id])
            ->first();
            
          $this->loadModel('TutorialSkills');
          $tutorialskills = $this->TutorialSkills
            ->find('list', ['keyField' => 'skill_id', 'valueField' => 'skill_name'])
            ->where(['tutorial_id' => $tutorial->id])
            ->toArray();
          
        
        $this->set(compact('tutorial', 'skills', 'industries', 'tutorialskills'));
        $this->set('_serialize', ['jobs']);
    }
    
      
      
      
      public function skillsaction($id, $skillids)
      {   
        $this->loadModel('TutorialSkills');       
        $this->TutorialSkills->deleteAll(['tutorial_id' => $id]);
        $this->loadModel('Skills');

        foreach($skillids as $key => $val){
   
             if(($val <> '') && ($val <> 0) ) {
               
                  $sk = $this->Skills->find('all', ['conditions' => ['id' => $val]])->first();
           
          				$TutorialskillsTable = TableRegistry::get('TutorialSkills');
                  $tutorialskills = $TutorialskillsTable->newEntity();
                  
     							$tutorialskills->tutorial_id = $id;
    							$tutorialskills->skill_id = $sk->id;
                  $tutorialskills->skill_name		=	$sk->name;
    					    $tutorialskills->slug		=	$sk->slug;
                  
                  $TutorialskillsTable->save($tutorialskills);
                       
              }
          }
           $newid = $id+1;
           $this->Flash->success(__('The Skills for this tutorial skills has been updated.'));
           return $this->redirect(['action' => 'skills',$newid]);
           
        }
        
    public function totwitter($id) {
  
    $this->loadModel('Tutorials'); 
    $tutorial = $this->Tutorials->find('all',['conditions'=>['id'=>$id]]);
    $tutorial = $tutorial->first();

    $twitterkeywordlist = '';

    $this->loadModel('TutorialSkills'); 
    $skills = $this->TutorialSkills->find('all',['conditions'=>['tutorial_id'=>$tutorial->id]]);
   
    foreach($skills as $key => $val){              
          $twitterkeywordlist .= '#'.trim($val->slug).' ';
    }
  
    $this->loadComponent('Codebird');
    $codebird = $this->Codebird->setConsumerKey(TWITTERCONSUMERKEY, TWITTERCONSUMERKEYSECRET);
    $bird = $this->Codebird->getInstance();
    $bird->setToken(TWITTERACCESSTOKEN, TWITTERACCESSTOKENSECRET);
  
    $params = array('status' => $tutorial->name.' http://www.skillbooker.com/tutorials/view/'.$tutorial->slug.'  '.$twitterkeywordlist); 
    $reply = $bird->statuses_update($params); 
    

    if(!empty($reply->id)) {
    
      $Table = TableRegistry::get('Tutorials');
      $update = $Table->get($tutorial->id); 
      $update->twittercount = $tutorial->twittercount + 1;
      $Table->save($update);
    
      $this->Flash->success(__('This tutorial has been added to Twitter.'));
    
    } else {
      $this->Flash->error(__('Twitter adding error.'));
    }
    
      return $this->redirect(['action' => 'index']);

  }
}
