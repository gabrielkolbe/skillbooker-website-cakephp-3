<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Projects Controller
 *
 * @property \Manager\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'projects');  
        
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
          //  'contain' => ['Industries', 'Users', 'Currencies'],
            'order' => ['Projects.id' => 'DESC']
        ];
        $projects = $this->paginate($this->Projects);

        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
    }
    
    

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Industries', 'Users', 'Currencies', 'Bids', 'Projectskills']
        ]);

        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $industries = $this->Projects->Industries->find('list', ['limit' => 200]);
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $currencies = $this->Projects->Currencies->find('list', ['limit' => 200]);
        $this->set(compact('project', 'industries', 'users', 'currencies'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $industries = $this->Projects->Industries->find('list', ['limit' => 200]);
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $currencies = $this->Projects->Currencies->find('list', ['limit' => 200]);
        $this->set(compact('project', 'industries', 'users', 'currencies'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
      public function totwitter($id) {
  
    $this->loadModel('Projects'); 
    $project = $this->Projects->find('all',['conditions'=>['id'=>$id]]);
    $project = $project->first();
  
    $twitterkeywordlist = '';

    $this->loadModel('Projectskills'); 
    $skills = $this->Projectskills->find('all',['conditions'=>['project_id'=>$project->id]]);
   
    foreach($skills as $key => $val){              
          $twitterkeywordlist .= '#'.trim($val->slug).' ';
    }
    
  
    $this->loadComponent('Codebird');
    $codebird = $this->Codebird->setConsumerKey(TWITTERCONSUMERKEY, TWITTERCONSUMERKEYSECRET);
    $bird = $this->Codebird->getInstance();
    $bird->setToken(TWITTERACCESSTOKEN, TWITTERACCESSTOKENSECRET);
  
    $params = array('status' => $project->name.' http://www.skillbooker.com/projects/fullview/'.$project->slug.'  '.$twitterkeywordlist);
    $reply = $bird->statuses_update($params); 
    

    if(!empty($reply->id)) {
    
      $Table = TableRegistry::get('Projects');
      $update = $Table->get($project->id); 
      $update->twittercount = $project->twittercount + 1;
      $Table->save($update);
    
      $this->Flash->success(__('This project has been added to Twitter.'));
    
    } else {
      $this->Flash->error(__('Twitter adding error.'));
    }
    
      return $this->redirect(['action' => 'index']);

  }

}
