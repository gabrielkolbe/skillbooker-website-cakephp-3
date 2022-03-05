<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Session; 

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class BidsController extends AppController
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
        
        $this->viewBuilder()->layout('frontside');
        $this->set('setstate', 'projects');
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
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
  
        
        $this->loadModel('Projects');
        $projects = $this->Projects->find('all', [
          'fields' => ['Projects.name', 'Projects.slug', 'Projects.denomination', 'Projects.amount', 'Projects.status', 'Projects.awardeduser', 'Projects.projecttype', 'Bids.id', 'Bids.denomination', 'Bids.amount', 'Bids.status', 'Bids.created'],
          'conditions' => ['Bids.user_id' => $user_id],
          'join' => [
                    [
                      'table' => 'bids',
                      'alias' => 'Bids',
                      'type' => 'LEFT',
                      'conditions' => [
                       'Projects.id = Bids.project_id'
                      ]
                    ]
          ],
         'order' => ['Projects.id' => 'DESC']    
        ]);
        
            
        $projects = $this->paginate($projects);

        $this->set(compact('projects', 'user_id'));
        $this->set('_serialize', ['projects']); 
                
    }
    
    
            public function workflow($slug = null)
    {
    
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->loadModel('Projects');
        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug, 'awardeduser' => $user_id]
        ]);
        $project = $project->first();
        $owner_id = $project->user_id;
        

        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project is not associated with you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'bids', 'action' => 'index']);
        }
        
        if( ($project->status == 'Awarded') || ($project->status == 'Completed') ) { } else {
            $this->Flash->error(__('Sorry, this project has to be awarded first.'));
            return $this->redirect(['plugin' => null, 'controller' => 'bids', 'action' => 'index']);
        }
        
        $this->loadModel('Users');
        $owner = $this->Users->find('all', [ 
          'conditions' => ['id' => $owner_id]
        ]);
        $owner = $owner->first();
        $this->set('owner', $owner);
        
         $this->set('project', $project);
         
          $this->loadModel('Notes');
          $notes = $this->Notes->find('all', [ 
            'conditions' => ['project_id' => $project->id]
          ]);
          
          $this->set('notes', $notes);
         
        if($project->projecttype == 2) {
        
          $this->loadModel('Extrahours');
          $extrahours = $this->Extrahours->find('all', [ 
            'conditions' => ['project_id' => $project->id]
          ]);
          
          $this->set('extrahours', $extrahours);
        
          $this->render('workflowhourly');
        } else {
         $this->render('workflow');
        }
    }
    
    
        public function delete($id = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->request->allowMethod(['post', 'delete']);
        
        $bid = $this->Bids->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $bid = $bid->first();
        
        if(empty($bid->id)){
            $this->Flash->error(__('Sorry, this bid does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'bids', 'action' => 'index']);
        }
        
        if ($this->Bids->delete($bid)) {
            $this->Flash->success(__('The bid has been deleted.'));
        } else {
            $this->Flash->error(__('The bid could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
        
   public function reasonModal($id){

    $this->viewBuilder()->layout('ajax');

    $user_id = $this->Auth->user('id'); 
    
    $bids = $this->Bids->find('all', [ 
          'conditions' => ['id' => $id, 'owner_id' => $user_id, 'status' => 'Submitted']
    ]);
    $bids = $bids->first();
    
    $this->set('bids', $bids);
    
    $Table = TableRegistry::get('Users');
    $user = $Table->get($bids->user_id);

    $this->set('name', $user->name);
    $this->set('slug', $user->slug);
          
    
	}
    

   
}
