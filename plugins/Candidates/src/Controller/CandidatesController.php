<?php
namespace Candidates\Controller;

use Candidates\Controller\AppController;
use Cake\Event\Event;

/**
 * Candidates Controller
 *
 * @property \Candidates\Model\Table\CandidatesTable $Candidates
 */
class CandidatesController extends AppController
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
            'contain' => ['Users', 'CandidateStatuses', 'CandidateRatings', 'CandidateSources', 'Companies', 'Jobtypes', 'Contactmethods']
        ];
        $candidates = $this->paginate($this->Candidates);

        $this->set(compact('candidates'));
        $this->set('_serialize', ['candidates']);
    }

    /**
     * View method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidate = $this->Candidates->get($id, [
            'contain' => ['Users', 'CandidateStatuses', 'CandidateRatings', 'CandidateSources', 'Companies', 'Jobtypes', 'Contactmethods']
        ]);

        $this->set('candidate', $candidate);
        $this->set('_serialize', ['candidate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidate = $this->Candidates->newEntity();
        if ($this->request->is('post')) {
            $candidate = $this->Candidates->patchEntity($candidate, $this->request->data);
            if ($this->Candidates->save($candidate)) {
                $this->Flash->success(__('The candidate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidate could not be saved. Please, try again.'));
        }
        $users = $this->Candidates->Users->find('list', ['limit' => 200]);
        $candidateStatuses = $this->Candidates->CandidateStatuses->find('list', ['limit' => 200]);
        $candidateRatings = $this->Candidates->CandidateRatings->find('list', ['limit' => 200]);
        $candidateSources = $this->Candidates->CandidateSources->find('list', ['limit' => 200]);
        $companies = $this->Candidates->Companies->find('list', ['limit' => 200]);
        $jobtypes = $this->Candidates->Jobtypes->find('list', ['limit' => 200]);
        $contactmethods = $this->Candidates->Contactmethods->find('list', ['limit' => 200]);
        $this->set(compact('candidate', 'users', 'candidateStatuses', 'candidateRatings', 'candidateSources', 'companies', 'jobtypes', 'contactmethods'));
        $this->set('_serialize', ['candidate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidate = $this->Candidates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidate = $this->Candidates->patchEntity($candidate, $this->request->data);
            if ($this->Candidates->save($candidate)) {
                $this->Flash->success(__('The candidate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidate could not be saved. Please, try again.'));
        }
        $users = $this->Candidates->Users->find('list', ['limit' => 200]);
        $candidateStatuses = $this->Candidates->CandidateStatuses->find('list', ['limit' => 200]);
        $candidateRatings = $this->Candidates->CandidateRatings->find('list', ['limit' => 200]);
        $candidateSources = $this->Candidates->CandidateSources->find('list', ['limit' => 200]);
        $companies = $this->Candidates->Companies->find('list', ['limit' => 200]);
        $jobtypes = $this->Candidates->Jobtypes->find('list', ['limit' => 200]);
        $contactmethods = $this->Candidates->Contactmethods->find('list', ['limit' => 200]);
        $this->set(compact('candidate', 'users', 'candidateStatuses', 'candidateRatings', 'candidateSources', 'companies', 'jobtypes', 'contactmethods'));
        $this->set('_serialize', ['candidate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidate = $this->Candidates->get($id);
        if ($this->Candidates->delete($candidate)) {
            $this->Flash->success(__('The candidate has been deleted.'));
        } else {
            $this->Flash->error(__('The candidate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
