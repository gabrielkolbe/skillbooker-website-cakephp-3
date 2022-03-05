<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * TutorialSkills Controller
 *
 * @property \Manager\Model\Table\TutorialSkillsTable $TutorialSkills
 */
class TutorialSkillsController extends AppController
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
            'contain' => ['Tutorials', 'Skills']
        ];
        $tutorialSkills = $this->paginate($this->TutorialSkills);

        $this->set(compact('tutorialSkills'));
        $this->set('_serialize', ['tutorialSkills']);
    }

    /**
     * View method
     *
     * @param string|null $id Tutorial Skill id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tutorialSkill = $this->TutorialSkills->get($id, [
            'contain' => ['Tutorials', 'Skills']
        ]);

        $this->set('tutorialSkill', $tutorialSkill);
        $this->set('_serialize', ['tutorialSkill']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tutorialSkill = $this->TutorialSkills->newEntity();
        if ($this->request->is('post')) {
            $tutorialSkill = $this->TutorialSkills->patchEntity($tutorialSkill, $this->request->data);
            if ($this->TutorialSkills->save($tutorialSkill)) {
                $this->Flash->success(__('The tutorial skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial skill could not be saved. Please, try again.'));
        }
        $tutorials = $this->TutorialSkills->Tutorials->find('list', ['limit' => 200]);
        $skills = $this->TutorialSkills->Skills->find('list', ['limit' => 200]);
        $this->set(compact('tutorialSkill', 'tutorials', 'skills'));
        $this->set('_serialize', ['tutorialSkill']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tutorial Skill id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tutorialSkill = $this->TutorialSkills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tutorialSkill = $this->TutorialSkills->patchEntity($tutorialSkill, $this->request->data);
            if ($this->TutorialSkills->save($tutorialSkill)) {
                $this->Flash->success(__('The tutorial skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial skill could not be saved. Please, try again.'));
        }
        $tutorials = $this->TutorialSkills->Tutorials->find('list', ['limit' => 200]);
        $skills = $this->TutorialSkills->Skills->find('list', ['limit' => 200]);
        $this->set(compact('tutorialSkill', 'tutorials', 'skills'));
        $this->set('_serialize', ['tutorialSkill']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tutorial Skill id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tutorialSkill = $this->TutorialSkills->get($id);
        if ($this->TutorialSkills->delete($tutorialSkill)) {
            $this->Flash->success(__('The tutorial skill has been deleted.'));
        } else {
            $this->Flash->error(__('The tutorial skill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
