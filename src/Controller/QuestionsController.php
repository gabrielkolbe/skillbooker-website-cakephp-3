<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Session; 

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 */
class QuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
          $this->Auth->allow();
        
        $this->viewBuilder()->layout('front');
        $this->set('setstate', 'questions');
        $this->set('pagetitle', 'Skillbooker.com -  Questions');
        $this->set('taglist', 'Questions');
        $this->set('pagedescription', 'Skillbooker.com -  Questions'); 
    }
    
    public function isAuthorized($user)
    {
    
        if (isset($user['role_id']) && $user['role_id'] == '1') {
            return true;             
        }
        
         return parent::isAuthorized($user);
    } 
     
     
    public function index()
    {
        $session = $this->request->session();
        
      	if($session->check('questionsearch')){
              $search = $session->read('questionsearch');
      	}
        
        if ($this->request->is('post')) {
        if($this->request->data['sendfrom'] == 'freesearch'){
        
        if(!empty($this->request->data['searchword'])) {
            $search = $this->request->data['searchword'];  
        }
        
          if(!empty($search)) {
          $this->paginate = [
                'conditions' => ['Questions.parent_id'=>0, 
                'OR' => [
                  'Questions.name LIKE' => "%$search%",
                  'Questions.content LIKE' => "%$search%",
                ]
                ]
                    
            ];
            
        $session->write('questionsearch',$search);
        
        $questions = $this->paginate($questions);
        
        } else {
         $search = '';
        }
        
        }
        
        if($this->request->data['sendfrom'] == 'skillsearch') {
        
          if(!empty($this->request->data['skill'])) {
            $skill_list = $this->request->data['skill'];
   
            $skillids = '';
            foreach($skill_list as $k => $v) {
                $skillids .= $v.',';
            }
            
            $skillids = rtrim($skillids,',');
            
             if(!empty($skillids)){
             
                $this->loadModel('QuestionSkills');
                $ids = $this->QuestionSkills->find('all',['fields' => ['question_id'], 'conditions'=>['QuestionSkills.skill_id IN ('.$skillids.')']]);
            
                $idslist = '0,';
                foreach($ids as $question) {
                  $idslist .= $question->question_id.',';
                }
                $idslist = rtrim($idslist,','); 
          
                $skillcondition = 'Questions.id IN ('.$idslist.')';
                
                if(empty($skillcondition)){
                  $skillcondition = '1 = 1';
                }
                
                $questions = $this->Questions->find('all',[
                'conditions'=>[$skillcondition, 'Questions.parent_id = 0']               
                ]);
                 $questions = $this->paginate($questions);
          
              } 
              
            $selectedquestionskills = array_flip ($skill_list); 
            $session->write('selectedquestionskills',$selectedquestionskills);
            $this->set('selectedquestionskills', $selectedquestionskills);  
              
          } else {
            $this->set('selectedquestionskills', '');
          }
        
        
        }
        
        } else { 
        
        $this->paginate = [
            'conditions' => ['Questions.parent_id'=>0]  
        ];
        $this->paginate['order'] = ['Questions.id' => 'DESC'];
        $questions = $this->paginate($this->Questions);
        
        }

        $this->set(compact('questions'));
        $this->set('_serialize', ['questions']);
        
        $this->loadModel('QuestionskillDistincts');
        $questionskillsdistinct = $this->QuestionskillDistincts->find('list',[ 
        'keyField' => 'skill_id', 'valueField' => 'skill_name']);
        
        $this->set('questionskillsdistinct', $questionskillsdistinct);
        
        if(($session->check('selectedquestionskills')) == true){
          $selectedquestionskills = $session->read('selectedquestionskills');
          $this->set('selectedquestionskills', $selectedquestionskills);
        } else {
          $this->set('selectedquestionskills', '');
        }
        
         
    }
    
        public function lists()
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->viewBuilder()->layout('frontside');
         
        $this->paginate = [
            'conditions' => ['Questions.user_id' => $user_id]   
        ];
        $this->paginate['order'] = ['Questions.id' => 'DESC'];
        
        $questions = $this->paginate($this->Questions);

        $this->set(compact('questions'));
        $this->set('_serialize', ['questions']);
        
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug, 'parent_id' => 0]
        ]);
        $question = $question->first();
        
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        $questioncomments = '';
        $this->loadModel('QuestionComments');
        $questioncomments = $this->QuestionComments->find('all', [
                  'conditions' => ['QuestionComments.question_id' => $question->id],
                  'order' => ['QuestionComments.id ASC']                               
        ]);
        
        $this->set('questioncomments', $questioncomments);
        
        $this->loadModel('QuestionSkills');
        $questionskills = $this->QuestionSkills->find('all',[ 
        'conditions'=>['QuestionSkills.question_id'=>$question->id]
        ]);

        $this->set('skills', $questionskills);

        $this->set('question', $question);
        $this->set('_serialize', ['question']);
        
        $this->loadModel('QuestionskillDistincts');
        $questionskillsdistinct = $this->QuestionskillDistincts->find('list',[ 
        'keyField' => 'skill_id', 'valueField' => 'skill_name']);
        
        $this->set('questionskillsdistinct', $questionskillsdistinct);
        
        $answers = $this->Questions->find('all',[ 
        'conditions'=>['Questions.parent_id'=>$question->id],
        'order' => 'Questions.votes DESC, Questions.id ASC'
        ]);
        
        $this->set('answers', $answers);
        
        $answercomments = '';
        foreach($answers as $answer) {
        
        $this->loadModel('QuestionComments');
        $answercomments = $this->QuestionComments->find('all', [
                  'conditions' => ['QuestionComments.question_id' => $answer->id],
                  'order' => ['QuestionComments.id ASC']                               
        ]);
        }
        
        $this->set('answercomments', $answercomments);
        
        $Table = TableRegistry::get('Questions');
        $update = $Table->get($question->id);

        $update->hitcount = $question->hitcount + 1;
        $Table->save($update);
        
        $this->set('pagedescription', $question->name);
        
        $this->set('pagetitle', $question->name.' - Skillbooker.com');
        
        $taglist = ''; 
        foreach($questionskills as $sk) {
          $taglist .= $sk->skill_name.', ';
        }
        
        $this->set('taglist', $taglist); 

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function ask()
    {
        $this->viewBuilder()->layout('frontside');
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
            $username = $this->Auth->user('name');
            $userslug = $this->Auth->user('slug');
            $userreputation = $this->Auth->user('reputation');
        }
          
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            
            $question->name = ucwords(strtolower($question->name));
            
            $this->loadComponent('slugcreator');
            $question->slug = $this->slugcreator->userslug($question->name);
            
            $question->user_id = $user_id;
            $question->username = $username;
            $question->userslug = $userslug;
            $question->userreputation = $userreputation;
            
            $question->parent_id = 0;
            $question->industry_id = 0;
            $question->status = 1;
            $question->twittercount = 0;
            $question->hitcount = 0;
            $question->votes = 0;
            $question->answers = 0; 
            $question->skills = 'none';
            
            $this->loadComponent('Removehtml');                    
            $question->content= $this->Removehtml->cleanhtml($question->content);
             
           //  dd($question);
            
            if ($this->Questions->save($question)) {
            $this->scancontentforskills($question->content, $question->id);

                
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['action' => 'skills', $question->slug]);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }       
        
        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        
        $this->viewBuilder()->layout('frontside');
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->viewBuilder()->layout('frontside');
        
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $question = $question->first();
          
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            
            $question->name = ucwords(strtolower($question->name));
            
            $this->loadComponent('slugcreator');
            $question->slug = $this->slugcreator->userslug($question->name);
    /*        
          $this->loadModel('QuestionSkills');       
          $this->QuestionSkills->deleteAll(['question_id' => $question->id]);
              
          $this->loadModel('Skills');
  
          foreach($this->request->data['skill_id'] as $key => $val){
     
          if(($val <> '') && ($val <> 0) ) {
                 
                    $sk = $this->Skills->find('all', ['conditions' => ['id' => $val]])->first();
             
            				$Table = TableRegistry::get('QuestionSkills');
                    $questionskills = $Table->newEntity();
                    
       							$questionskills->question_id = $question->id;
      							$questionskills->skill_id = $sk->id;
                    $questionskills->skill_name		=	$sk->name;
      					    $questionskills->slug		=	$sk->slug;
                    $questionskills->industry_id	=	$sk->industry_id;
                    $questionskills->created	=	date('Y-m-d');
                    
                    $Table->save($questionskills);
                         
                }
            }

      */
            $this->loadComponent('Removehtml');                    
            $question->content= $this->Removehtml->cleanhtml($question->content);
            
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'lists']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        
        $this->loadModel('Skills');
        $skills = $this->Skills->find('list', ['keyField' => 'id', 'valueField' => 'name']);         
                    
        $this->loadModel('QuestionSkills');
        $questionskills = $this->QuestionSkills->find('list',[ 
        'keyField' => 'skill_id', 'valueField' => 'skill_name', 'conditions'=>['QuestionSkills.question_id'=>$question->id]
        ]);
        $questionskills = $questionskills->toArray();   

        $this->set(compact('question', 'skills', 'questionskills'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     
    public function delete($slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->viewBuilder()->layout('frontside');
        
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $question = $question->first();
        
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        if ($this->Questions->delete($question)) {
        
            $this->Questions->deleteAll(['parent_id ' => $question->id]);
            
            $this->loadModel('QuestionComments');
            $this->QuestionComments->deleteAll(['QuestionComments.question_id ' => $question->id]);
            $this->QuestionComments->deleteAll(['QuestionComments.parent_id ' => $question->id]);
            
            
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
  public function skills($slug = null)
  {
    
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->viewBuilder()->layout('frontside');
        
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $question = $question->first();
        
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        
        $this->viewBuilder()->layout('frontside');

        
        if ($this->request->is('post')) {
        
          $this->loadModel('QuestionSkills');       
          $this->QuestionSkills->deleteAll(['question_id' => $question->id]);
              
          $this->loadModel('Skills');
  
          if(!empty($this->request->data['skill_id'])) {
          foreach($this->request->data['skill_id'] as $key => $val){
     
          if(($val <> '') && ($val <> 0) ) {
                 
                    $sk = $this->Skills->find('all', ['conditions' => ['id' => $val]])->first();
             
            				$Table = TableRegistry::get('QuestionSkills');
                    $questionskills = $Table->newEntity();
                    
       							$questionskills->question_id = $question->id;
      							$questionskills->skill_id = $sk->id;
                    $questionskills->skill_name		=	$sk->name;
      					    $questionskills->slug		=	$sk->slug;
                    $questionskills->industry_id	=	$sk->industry_id;
                    $questionskills->created	=	date('Y-m-d');
                    
                    $Table->save($questionskills);
                         
                }
            }
          } else {
            $this->Flash->success(__('No skills where selected.'));
            return $this->redirect(['plugin' => null, 'controller' => 'questions', 'action' => 'lists']);
          }
            
          $this->updateskilllist($question->id);
          
           $this->Flash->success(__('The Skills for this question has been updated.'));
           return $this->redirect(['plugin' => null, 'controller' => 'questions', 'action' => 'lists']);
        }
        
        $this->loadModel('Skills');
        $skills = $this->Skills->find('list', ['keyField' => 'id', 'valueField' => 'name']);
            
        $this->loadModel('QuestionSkills');
        $questionskills = $this->QuestionSkills->find('list',[ 
        'keyField' => 'skill_id', 'valueField' => 'skill_name', 'conditions'=>['QuestionSkills.question_id'=>$question->id]
        ]);
        $questionskills = $questionskills->toArray(); 
          
        
        $this->set(compact('question', 'skills', 'questionskills'));
        $this->set('_serialize', ['question']);
    }
    



    
           public function scancontentforskills($content, $question_id)
    {   

          $this->loadComponent('Filereader');                  
            
              $Table = TableRegistry::get('Skills');
              $skills = $Table->find('all');	
         
								foreach($skills as $skill) {                         			
            										                  
                    $tempobject = $this->Filereader->searchwordlowercase($content,$skill->slug);

										if(!empty($tempobject)) { 
                    
                      $Table_us = TableRegistry::get('QuestionSkills');
											$skill_entry = $Table_us->find('all',['conditions'=>['question_id' => $question_id, 'slug'=>$skill->slug]]);
                      $entrycount = $skill_entry->count();
                        
                      if($entrycount < 1) {
                      
                        $addskill = $Table_us->newEntity();
                        
                        $addskill->question_id		=	$question_id;
          							$addskill->skill_id			=	$skill->id;
                        $addskill->skill_name	=	$skill->name;
          							$addskill->slug	=	$skill->slug;
                        $addskill->industry_id =	$skill->industry_id;
                        $addskill->created =	date('Y-m-d');        
          
                        $Table_us->save($addskill);
                        
											}
										}
                   
								 }      

    }
    
      public function updateskilllist($question_id)
    {   
        $this->loadModel('QuestionSkills');
        $questionskills = $this->QuestionSkills->find('list',[ 
        'keyField' => 'skill_id', 'valueField' => 'skill_name', 'conditions'=>['QuestionSkills.question_id'=>$question_id]
        ]);
        $questionskills = $questionskills->toArray();
        
        $skilllist = '';
        foreach($questionskills as $key => $value) {
         $skilllist .= $value.',';
        }
        $skilllist = rtrim($skilllist, ',');
        
        $Table = TableRegistry::get('Questions');
        $update = $Table->get($question_id);
        
        $update->skills = $skilllist;
        $Table->save($update);
     }
     
     
     
        public function search($slug=null) {
      
      if($slug == null) {
        $this->Flash->success(__('Your search criteria is empty.'));
        return $this->redirect(['controller' => 'questions', 'action' => 'index']);
      }
      
      $this->loadModel('QuestionSkills');
      $skills =  $this->QuestionSkills->find('all', ['conditions'=>['QuestionSkills.slug' => $slug], 'fields' => ['QuestionSkills.question_id']]);

      $ids = '';
      foreach($skills as $key => $value) {
       $ids .= $value->question_id.',';
      }
     
      $ids = rtrim($ids, ','); 

      $questions = $this->Questions->find('all',['conditions'=>['Questions.id IN ('.$ids.')']]);
      $questions = $this->paginate($questions);
      $this->set(compact('questions'));

    	$this->set('pagedescription', 'Questions and Answers for technology');
      
      $this->render('index');	   
    }
    
    
      public function answerquestion()
    {    

        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
            $username = $this->Auth->user('name');
            $userslug = $this->Auth->user('slug');
            $userreputation = $this->Auth->user('reputation');
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
        
        if(!empty($this->request->data['slug'])) { $slug = $this->request->data['slug']; }
        if(!empty($this->request->data['content'])) { $content = $this->request->data['content']; }
        
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug]
        ]);
        $question = $question->first();
        
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question could not be found.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        if($question->user_id == $user_id) {
            $this->Flash->error(__('Sorry, you can not answer your own question, please edit your question or make a comment instead.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'view', $slug]);
        }
        
        $checkuser = $this->Questions->find('all', [ 
          'conditions' => ['Questions.user_id' => $user_id, 'Questions.parent_id' => $question->id]
        ]);
        $checkuser = $checkuser->first();
        
        if(!empty($checkuser->id)) {
            $this->Flash->error(__('Sorry, you can not answer more than once, please edit your answer or make a comment instead.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'view', $slug]);
        }

        $Table = TableRegistry::get('Questions');
        $insert = $Table->newEntity();
        
        $insert->name = 'answer';
        $insert->slug = $question->slug;
        $insert->user_id = $user_id;
        $insert->username = $username;
        $insert->userslug = $userslug;
        $insert->userreputation = $userreputation;
        $insert->parent_id = $question->id;
        $insert->content = $content;
        $insert->created = date('Y-m-d');
        $insert->modified = date('Y-m-d');
        
       // dd($insert);
        
        if ($Table->save($insert)) {
        
            $Table = TableRegistry::get('Questions');
            $update = $Table->get($question->id);
    
            $update->answers = $update->answers + 1;
            $Table->save($update);
        
            $this->Flash->success(__('Your question has been added.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'view', $slug]);
        } else {
            $this->Flash->error(__('Your question could not been added.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'view', $slug]);
        }
        
        }

    }
    
    
        public function editQuestionModal($slug = null)
    {
        
        $this->viewBuilder()->layout('ajax');
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $question = $question->first();

        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }

        public function editQuestionAction($slug = null)
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $question = $question->first();
          
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
            return $this->redirect($this->referer()); 
        } 

        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }
    
    
            public function deleteQuestionModal($slug = null)
    {
        
        $this->editQuestionModal($slug);
    }
    
            public function deleteQuestionAction($slug = null)
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $question = $question->first();
          
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {

          if ($this->Questions->delete($question)) {
          
            $this->Questions->deleteAll(['parent_id ' => $question->id]);
            
            $this->loadModel('QuestionComments');
            $this->QuestionComments->deleteAll(['QuestionComments.question_id ' => $question->id]);
            $this->QuestionComments->deleteAll(['QuestionComments.parent_id ' => $question->id]);
  
  
              $this->Flash->success(__('The question has been deleted.'));
          } else {
              $this->Flash->error(__('The question could not be deleted. Please, try again.'));
          }
        
            return $this->redirect(['plugin' => null, 'controller' => 'questions', 'action' => 'index']);
        } 

        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }
    
    
    
        public function disassociateQuestionAction($slug = null)
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        
        $question = $this->Questions->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $question = $question->first();
          
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
       
            $this->loadModel('Users'); 
            $adminuser = $this->Users->find('all', [ 
              'conditions' => ['id' => 1]
            ]);
            $adminuser = $adminuser->first();

            $Table = TableRegistry::get('Questions');
            $update = $Table->get($question->id);
    
            $update->user_id = 1;
            $update->username = $adminuser->name;
            $update->userslug = $adminuser->slug;
            $update->userreputation = $adminuser->reputation;
            
            if ($Table->save($update)) {
              $this->Flash->success(__('The question has been disassociate, this can not be reveresed.'));
          } else {
              $this->Flash->error(__('The question could not be disassociate. Please, contact support.'));
          }
        
            return $this->redirect(['plugin' => null, 'controller' => 'questions', 'action' => 'index']);
        } 

        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }




    
      public function editAnswerModal($id = null)
    {
        
        $this->viewBuilder()->layout('ajax');
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $answer = $this->Questions->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $answer = $answer->first();
        
        if(empty($answer->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }

        $this->set(compact('answer'));
        $this->set('_serialize', ['answer']);
    }
    
          public function editAnswerAction($id = null)
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $answer = $this->Questions->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $answer = $answer->first();
        
        if(empty($answer->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        

        if ($this->request->is(['patch', 'post', 'put'])) {
            $answer = $this->Questions->patchEntity($answer, $this->request->data);
            
            if ($this->Questions->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));
            } else {
                $this->Flash->error(__('The answer could not be saved. Please, try again.'));
            }
            return $this->redirect($this->referer()); 
        } 

        $this->set(compact('answer'));
        $this->set('_serialize', ['answer']);
    }
    
    
      public function deleteAnswerModal($id = null)
    {
        
        $this->editAnswerModal($id);
    }
    
      public function deleteAnswerAction($id = null)
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        

        $answer = $this->Questions->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $answer = $answer->first();
        $question_id = $answer->parent_id;
        
        if(empty($answer->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {

          if ($this->Questions->delete($answer)) {
          
            $this->loadModel('QuestionComments');
            $this->QuestionComments->deleteAll(['QuestionComments.parent_id ' => $answer->id]);
          
            $Table = TableRegistry::get('Questions');
            $update = $Table->get($question_id);
    
            $update->answers = $update->answers - 1;
            $Table->save($update);
            
            $this->Flash->success(__('The answer has been deleted.'));
            
          } else {
            $this->Flash->error(__('The answer could not be deleted. Please, try again.'));
          }
        
            return $this->redirect(['plugin' => null, 'controller' => 'questions', 'action' => 'index']);
        } 

        $this->set(compact('answer'));
        $this->set('_serialize', ['answer']);
    }
    
    
          public function addCommentModal($id = null)
    {
        
        $this->viewBuilder()->layout('ajax');
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }

        $question = $this->Questions->find('all', [ 
          'conditions' => ['id' => $id]
        ]);
        
        $question = $question->first();
        
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }

        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    } 
    
    
          public function addCommentAction($question_id = null)
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
            $username = $this->Auth->user('name');
            $userslug = $this->Auth->user('slug');
        }

        $question = $this->Questions->find('all', [ 
          'conditions' => ['Questions.id' => $question_id]
        ]);
        $question = $question->first();

        
        if(empty($question->id)){
            $this->Flash->error(__('Sorry, this question does not exist.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }
        
          if ($this->request->is(['patch', 'post', 'put'])) {

            $Table = TableRegistry::get('QuestionComments');
            $insert = $Table->newEntity();
    
            $insert->user_id = $user_id;
            $insert->question_id = $question->id;
            $insert->parent_id = $question->parent_id;
            $insert->comment = $this->request->data['comment'];
            $insert->username = $username;
            $insert->userslug = $userslug;
            $insert->created	=	date('Y-m-d h:i:s');
            $insert->modified	=	date('Y-m-d h:i:s');
            
          if ($Table->save($insert)) {
              $this->Flash->success(__('The comment has been saved.'));
          } else {
              $this->Flash->error(__('he comment could not be saved.'));
          }
          return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'view', $question->slug]);
        }
        
    } 
    
    
       
      public function editCommentModal($id = null)
    {
        
        $this->viewBuilder()->layout('ajax');
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->loadModel('QuestionComments');
        $comment = $this->QuestionComments->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $comment = $comment->first();
        
        if(empty($comment->id)){
            $this->Flash->error(__('Sorry, this comment does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }

        $this->set(compact('comment'));
        $this->set('_serialize', ['comment']);
    }
    
          public function editCommentAction($id = null)
    {
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->loadModel('QuestionComments');
        $comment = $this->QuestionComments->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $comment = $comment->first();
        
        if(empty($comment->id)){
            $this->Flash->error(__('Sorry, this comment does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
        }


        if ($this->request->is(['patch', 'post', 'put'])) {
            
          $Table = TableRegistry::get('QuestionComments');
            $update = $Table->get($id);
    
          if(!empty($this->request->data['comment'])) { 
            $comment = $this->request->data['comment'];
            $update->comment = $comment;
            
            if ($Table->save($update)) {
                $this->Flash->success(__('The comment has been updated.'));
            } else {
                $this->Flash->error(__('The comment could not been updated.'));
            }
          } else {
           $this->Flash->error(__('The comment was empty.'));
          }
          return $this->redirect($this->referer());    
        } 

        $this->set(compact('comment'));
        $this->set('_serialize', ['comment']);
    }
    
          public function deleteCommentModal($id = null)
    {
        
        $this->editCommentModal($id);
    }
    
      
      public function deleteCommentAction($id = null)
    {
        
          if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
          } else {
              $user_id = $this->Auth->user('id');
          }
          
          $this->loadModel('QuestionComments');
          $comment = $this->QuestionComments->find('all', [ 
            'conditions' => ['id' => $id, 'user_id' => $user_id]
          ]);
          $comment = $comment->first();
          
          if(empty($comment->id)){
              $this->Flash->error(__('Sorry, this comment does not belong to you.'));
              return $this->redirect(['plugin' => null, 'controller' => 'Questions', 'action' => 'index']);
          }
            
          if ($this->request->is(['patch', 'post', 'put'])) {
            
            $this->loadModel('QuestionComments');
            if ($this->QuestionComments->delete($comment)) {
              $this->Flash->success(__('The comment has been deleted.'));
            } else {
              $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
            }
           return $this->redirect($this->referer());
          }
    }

       public function test()
    {
    
        $questions = $this->Questions->find('all',[ 
        'order' => 'Questions.votes DESC, Questions.id ASC'
        ]);
        
        $this->set('questions', $questions);
      
        if($_POST) {
        
        $this->log($_POST , 'debug');
        
        $id = $_POST['id'];
        $value = $_POST['value'];
        
        $articlesTable = TableRegistry::get('Questions');
        $article = $articlesTable->get($id); // Return article with id 12
        
        $article->vote = $value;
        $articlesTable->save($article);

        	$expire = 24*3600; // 1 day
        	//setcookie('tcVotingSystem'.$id, 'voted', time() + $expire, '/'); // Place a cookie
        
          $this->set('value', $value);	
        	//echo $value['total']; // Send back the new number value
        }
       
    }
   
}
