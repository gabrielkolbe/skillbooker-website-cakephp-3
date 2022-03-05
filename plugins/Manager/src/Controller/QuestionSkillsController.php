<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * QuestionSkills Controller
 *
 * @property \Qanda\Model\Table\QuestionSkillsTable $QuestionSkills
 */
class QuestionSkillsController extends AppController
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
            'contain' => ['Questions', 'Skills', 'Industries']
        ];
        $questionSkills = $this->paginate($this->QuestionSkills);

        $this->set(compact('questionSkills'));
        $this->set('_serialize', ['questionSkills']);
    }

    /**
     * View method
     *
     * @param string|null $id Question Skill id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionSkill = $this->QuestionSkills->get($id, [
            'contain' => ['Questions', 'Skills', 'Industries']
        ]);

        $this->set('questionSkill', $questionSkill);
        $this->set('_serialize', ['questionSkill']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionSkill = $this->QuestionSkills->newEntity();
        if ($this->request->is('post')) {
            $questionSkill = $this->QuestionSkills->patchEntity($questionSkill, $this->request->data);
            if ($this->QuestionSkills->save($questionSkill)) {
                $this->Flash->success(__('The question skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question skill could not be saved. Please, try again.'));
        }
        $questions = $this->QuestionSkills->Questions->find('list', ['limit' => 200]);
        $skills = $this->QuestionSkills->Skills->find('list', ['limit' => 200]);
        $industries = $this->QuestionSkills->Industries->find('list', ['limit' => 200]);
        $this->set(compact('questionSkill', 'questions', 'skills', 'industries'));
        $this->set('_serialize', ['questionSkill']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Question Skill id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionSkill = $this->QuestionSkills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionSkill = $this->QuestionSkills->patchEntity($questionSkill, $this->request->data);
            if ($this->QuestionSkills->save($questionSkill)) {
                $this->Flash->success(__('The question skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question skill could not be saved. Please, try again.'));
        }
        $questions = $this->QuestionSkills->Questions->find('list', ['limit' => 200]);
        $skills = $this->QuestionSkills->Skills->find('list', ['limit' => 200]);
        $industries = $this->QuestionSkills->Industries->find('list', ['limit' => 200]);
        $this->set(compact('questionSkill', 'questions', 'skills', 'industries'));
        $this->set('_serialize', ['questionSkill']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question Skill id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionSkill = $this->QuestionSkills->get($id);
        if ($this->QuestionSkills->delete($questionSkill)) {
            $this->Flash->success(__('The question skill has been deleted.'));
        } else {
            $this->Flash->error(__('The question skill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
