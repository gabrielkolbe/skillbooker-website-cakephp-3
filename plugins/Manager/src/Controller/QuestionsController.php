<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Questions Controller
 *
 * @property \Manager\Model\Table\QuestionsTable $Questions
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
        $this->set('setstate', 'jobs');  
        
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
            'contain' => ['Users'],
            'conditions' => ['Questions.parent_id' => 0],
            'order' => ['Questions.id' => 'DESC']
        ];
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
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Users', 'ParentQuestions', 'Industries', 'QuestionComments', 'QuestionSkills', 'ChildQuestions']
        ]);

        $this->set('question', $question);
        $this->set('_serialize', ['question']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $users = $this->Questions->Users->find('list', ['limit' => 200]);
        $parentQuestions = $this->Questions->ParentQuestions->find('list', ['limit' => 200]);
        $industries = $this->Questions->Industries->find('list', ['limit' => 200]);
        $this->set(compact('question', 'users', 'parentQuestions', 'industries'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $users = $this->Questions->Users->find('list', ['limit' => 200]);
        $parentQuestions = $this->Questions->ParentQuestions->find('list', ['limit' => 200]);
        $industries = $this->Questions->Industries->find('list', ['limit' => 200]);
        $this->set(compact('question', 'users', 'parentQuestions', 'industries'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function totwitter($id) {
  
    $this->loadModel('Questions'); 
    $question = $this->Questions->find('all',['conditions'=>['id'=>$id]]);
    $question = $question->first();

    $twitterkeywordlist = '';

    $this->loadModel('QuestionSkills'); 
    $skills = $this->QuestionSkills->find('all',['conditions'=>['question_id'=>$question->id]]);
   
    foreach($skills as $key => $val){              
          $twitterkeywordlist .= '#'.trim($val->slug).' ';
    }
  
    $this->loadComponent('Codebird');
    $codebird = $this->Codebird->setConsumerKey(TWITTERCONSUMERKEY, TWITTERCONSUMERKEYSECRET);
    $bird = $this->Codebird->getInstance();
    $bird->setToken(TWITTERACCESSTOKEN, TWITTERACCESSTOKENSECRET);
  
    $params = array('status' => $question->name.' http://www.skillbooker.com/questions/view/'.$question->slug.'  '.$twitterkeywordlist); 
    $reply = $bird->statuses_update($params); 
    

    if(!empty($reply->id)) {
    
      $Table = TableRegistry::get('Questions');
      $update = $Table->get($question->id); 
      $update->twittercount = $question->twittercount + 1;
      $Table->save($update);
    
      $this->Flash->success(__('This question has been added to Twitter.'));
    
    } else {
      $this->Flash->error(__('Twitter adding error.'));
    }
    
      return $this->redirect(['action' => 'index']);

  }
}
