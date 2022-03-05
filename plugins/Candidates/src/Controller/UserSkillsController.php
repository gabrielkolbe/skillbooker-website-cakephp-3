<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * UserSkills Controller
 *
 * @property \Candidates\Model\Table\UserSkillsTable $UserSkills
 */
class UserSkillsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'candidates');  
        
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
            'contain' => ['Users', 'Skills']
        ];
        $userSkills = $this->paginate($this->UserSkills);

        $this->set(compact('userSkills'));
        $this->set('_serialize', ['userSkills']);
    }

    /**
     * View method
     *
     * @param string|null $id User Skill id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userSkill = $this->UserSkills->get($id, [
            'contain' => ['Users', 'Skills']
        ]);

        $this->set('userSkill', $userSkill);
        $this->set('_serialize', ['userSkill']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userSkill = $this->UserSkills->newEntity();
        if ($this->request->is('post')) {
            $userSkill = $this->UserSkills->patchEntity($userSkill, $this->request->data);
            if ($this->UserSkills->save($userSkill)) {
                $this->Flash->success(__('The user skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user skill could not be saved. Please, try again.'));
        }
        $users = $this->UserSkills->Users->find('list', ['limit' => 200]);
        $skills = $this->UserSkills->Skills->find('list', ['limit' => 200]);
        $this->set(compact('userSkill', 'users', 'skills'));
        $this->set('_serialize', ['userSkill']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Skill id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userSkill = $this->UserSkills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userSkill = $this->UserSkills->patchEntity($userSkill, $this->request->data);
            if ($this->UserSkills->save($userSkill)) {
                $this->Flash->success(__('The user skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user skill could not be saved. Please, try again.'));
        }
        $users = $this->UserSkills->Users->find('list', ['limit' => 200]);
        $skills = $this->UserSkills->Skills->find('list', ['limit' => 200]);
        $this->set(compact('userSkill', 'users', 'skills'));
        $this->set('_serialize', ['userSkill']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Skill id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userSkill = $this->UserSkills->get($id);
        if ($this->UserSkills->delete($userSkill)) {
            $this->Flash->success(__('The user skill has been deleted.'));
        } else {
            $this->Flash->error(__('The user skill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
