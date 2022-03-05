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
          $this->Auth->allow();
        
        $this->viewBuilder()->layout('front');
        $this->set('setstate', 'projects');
        
        $this->set('pagetitle', 'Skillbooker.com -  Freelance Projects');
        $this->set('taglist', 'Freelance Projects');
        $this->set('pagedescription', 'Freelance Projects');  
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
       if ($this->request->is('post')) {
    
        if($this->request->data['sendfrom'] == 'projectsearch'){
        
         // dd($this->request->data);
        
          if(!empty($this->request->data['skill'])) {
            $skill_list = $this->request->data['skill'];
   
            $skillids = '';
            foreach($skill_list as $k => $v) {
                $skillids .= $v.',';
            }
            
            $skillids = rtrim($skillids,',');
            
             if(!empty($skillids)){
             
                $this->loadModel('Projectskills');
                $projectids = $this->Projectskills->find('all',['fields' => ['project_id'], 'conditions'=>['Projectskills.skill_id IN ('.$skillids.')']]);
            
                $projectidslist = '0,';
                foreach($projectids as $project) {
                  $projectidslist .= $project->project_id.',';
                }
                $projectidslist = rtrim($projectidslist,','); 
          
                $projectskillcondition = 'Projects.id IN ('.$projectidslist.')';
              } 
            $selectedprojectskills = array_flip ($skill_list); 
            $session->write('selectedprojectskills',$selectedprojectskills);
            $this->set('selectedprojectskills', $selectedprojectskills);  
              
          } else {
            $this->set('selectedprojectskills', '');
          }
          
          if(empty($projectskillcondition)){
            $projectskillcondition = '1 = 1';
          }                    
          
          if(!empty($this->request->data['projecttype_id'])) {
            $projecttype = $this->request->data['projecttype_id'];
            $session->write('projecttype',$projecttype);
            $this->set('projecttype', $projecttype);
            if($projecttype > 0){
             $typecondition = 'Projects.projecttype = '.$projecttype;
            } else {
             $typecondition = '1 = 1';
            }
          } else {
             $typecondition = '1 = 1';
             $this->set('projecttype', 0);
          }
              
                
          $results = $this->Projects->find('all',[
          'conditions'=>[$projectskillcondition, $typecondition, 'Projects.status = "live"']               
          ]);
          $this->paginate['order'] = ['Projects.created' => 'DESC'];
          
          $projects = $this->paginate($results);                    
          
        }
        
      }  else {
      
        $this->paginate = [
            'conditions' => ['Projects.status = "live"'],   
        ];
        $this->paginate['order'] = ['Projects.created' => 'DESC'];
        
        $projects = $this->paginate($this->Projects);
        
        if(($session->check('projecttype')) == true){
          $projecttype = $session->read('projecttype');
          $this->set('projecttype', $projecttype);
        } else {
          $this->set('projecttype', 0);
        }
        
        if(($session->check('selectedprojectskills')) == true){
          $selectedprojectskills = $session->read('selectedprojectskills');
          $this->set('selectedprojectskills', $selectedprojectskills);
        } else {
          $this->set('selectedprojectskills', '');
        }
      
      }     
        
        $this->loadModel('ProjectskillDistincts');
        $projectskillsdistinct = $this->ProjectskillDistincts->find('list', ['keyField' => 'skill_id', 'valueField' => 'skill_name']);
    		$this->set('projectskillsdistinct',$projectskillsdistinct);

        $this->set(compact('projects', 'projectskillsdistinct'));
        $this->set('_serialize', ['projects']);
        
        if(!is_null($this->Auth->user('id'))) {
            $user_id = $this->Auth->user('id');
            
          $this->loadModel('Bids');
          $bids = $this->Bids->find('all', [
            'fields' => ['Bids.project_id'],
            'conditions' => ['Bids.user_id' => $user_id], 
          ]);
          $mybids = array();
          foreach($bids as $bid) {
            $mybids[$bid->project_id] = $bid->project_id;
          }
          $this->set('mybids', $mybids);
          
          $canbid = $this->canbid();
          $this->set('canbid', $canbid);
        
        }
        
        
        
        $this->set('pagetitle', 'Skillbooker.com -  Freelance Projects');
        
        $pagedescription = 'Freelance projects, ';
        foreach($projects as $project) {
          $pagedescription .= $project->name.', ';
        }
        
        $this->set('pagedescription', $pagedescription);
        
        $this->set('taglist', 'Freelance Projects');
        
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
            'fields' => ['Freelancer.slug', 'Freelancer.name', 'Projects.name', 'Projects.slug', 'Projects.denomination', 'Projects.amount', 'Projects.awardedamount', 'Projects.projecttype', 'Projects.status', 'Projects.currentbids', 'Projects.created'],
            'conditions' => ['Projects.user_id = '.$user_id],
            'join' => [
                [
                  'table' => 'users',
                  'alias' => 'Freelancer',
                  'type' => 'LEFT',
                  'conditions' => [
                   'Freelancer.id = Projects.awardeduser'
                  ]
                ]
                
            ]    
        ];
        $this->paginate['order'] = ['Projects.id' => 'DESC'];
        
        $projects = $this->paginate($this->Projects);
        
        //$this->loadComponent('Encrypt');                  
        //$encrypt = $this->Encrypt->encode($sendvalues); 
        
        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
    }
    
    
    
      public function bids($slug = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        if($slug == null){
        
        $this->loadModel('Bids');
        $bids = $this->Bids->find('all', [
          'fields' => ['Projects.name', 'Projects.slug', 'Users.name', 'Users.slug', 'Bids.id', 'Bids.denomination', 'Bids.amount', 'Bids.status', 'Bids.rating', 'Bids.created'],
          'conditions' => ['Bids.owner_id' => $user_id, 'Bids.status <> ' => 'Rejected'],
          'join' => [
                    [
                      'table' => 'users',
                      'alias' => 'Users',
                      'type' => 'LEFT',
                      'conditions' => [
                       'Users.id = Bids.user_id'
                      ]
                    ],
                    [
                      'table' => 'projects',
                      'alias' => 'Projects',
                      'type' => 'LEFT',
                      'conditions' => [
                       'Projects.id = Bids.project_id'
                      ]
                    ]
          ],
         'order' => ['Bids.project_id' => 'ASC', 'Bids.rating' => 'DESC']    
        ]);
        
        
        
        } else { 
        
        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $project = $project->first();
        
        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project does exist on bids.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        $this->loadModel('Bids');
        $bids = $this->Bids->find('all', [
          'fields' => ['Projects.name', 'Projects.slug', 'Users.name', 'Users.slug', 'Bids.id', 'Bids.denomination', 'Bids.amount', 'Bids.status', 'Bids.rating', 'Bids.created'], 
          'conditions' => ['Bids.project_id' => $project->id, 'Bids.owner_id' => $user_id, 'Bids.status <> ' => 'Rejected'],
          'join' => [
                    [
                      'table' => 'users',
                      'alias' => 'Users',
                      'type' => 'LEFT',
                      'conditions' => [
                       'Users.id = Bids.user_id'
                      ]
                    ],[
                      'table' => 'projects',
                      'alias' => 'Projects',
                      'type' => 'LEFT',
                      'conditions' => [
                       'Projects.id = Bids.project_id'
                      ]
                    ]
          ],
         'order' => ['Bids.project_id' => 'ASC', 'Bids.rating' => 'DESC']   
        ]);
      
      }
    
        $bids = $this->paginate($bids);

        $this->set(compact('bids', 'project'));
        $this->set('_serialize', ['bids']); 
                
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $this->viewBuilder()->layout('ajax'); 
        
        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug]
        ]);
        $project = $project->first();
        
        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project cant be viewed.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }

        $this->set('project', $project);
        $this->set('_serialize', ['project']);
        
        if(!is_null($this->Auth->user('id'))) {
            $user_id = $this->Auth->user('id');
            
        $this->loadModel('Bids');
        $bids = $this->Bids->find('all', [
          'fields' => ['Bids.project_id'],
          'conditions' => ['Bids.user_id' => $user_id], 
        ]);
        $mybids = array();
        foreach($bids as $bid) {
          $mybids[$bid->project_id] = $bid->project_id;
        }
        $this->set('mybids', $mybids);
        }
        
        
        if($project->projecttype == 2) {
          $this->render('viewhourly');
        } else {
         $this->render('view');
        }
        

    }
    
    
        public function fullview($slug = null)
    {
        
        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug]
        ]);
        $project = $project->first();
        
        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project cant be viewed in full.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        $this->set('pagetitle', $project->name);
        $this->set('pagedescription', 'Freelance project: '.$project->name); 

        $this->set('project', $project);
        $this->set('_serialize', ['project']);
        
        if(!is_null($this->Auth->user('id'))) {
            $user_id = $this->Auth->user('id');
            
        $this->loadModel('Bids');
        $bids = $this->Bids->find('all', [
          'fields' => ['Bids.project_id'],
          'conditions' => ['Bids.user_id' => $user_id], 
        ]);
        $mybids = array();
        foreach($bids as $bid) {
          $mybids[$bid->project_id] = $bid->project_id;
        }
        $this->set('mybids', $mybids);
        }
        
        
        if($project->projecttype == 2) {
          $this->render('fullviewhourly');
        } else {
         $this->render('fullview');
        }
          

    } 
     
    
    
    
        public function addhourly($templateslug = null)
    {    
        $this->viewBuilder()->layout('frontside');
        $type = 2;
        $stageinterval = 1;
        $templateslug = $templateslug;
        $this->addproject($type, $stageinterval, $templateslug); 

    }
  
    
        public function add($templateslug = null)
    {
        $this->viewBuilder()->layout('frontside');
        $type = 1;
        $stageinterval = '';
        $templateslug = $templateslug;
        $this->addproject($type, $stageinterval, $templateslug); 
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addproject($type, $stageinterval, $templateslug = null)
    {
    
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        
        $project = $this->Projects->newEntity();

        if(!empty($templateslug)) {
        
        $this->loadModel('ProjectTemplates');
        $template = $this->ProjectTemplates->find('all', [ 
            'conditions' => ['slug' => $templateslug]
          ]);
        $template = $template->first();

        
        if(empty($template->id)){
            $this->Flash->error(__('Sorry, this template does not exist.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'add']);
        } else {
            $project->status = 'Live';
            $project->name = $template->name;
            $project->slug = $template->slug;
            $project->short_description = $template->short_description;
            $project->stage1 = $template->stage1;
            $project->stage2 = $template->stage2;
            $project->stage3 = $template->stage3;
            $project->stage4 = $template->stage4;
        
        }
        }

        $currencies = $this->Projects->Currencies->find('list', ['limit' => 200]);
        $this->set(compact('project', 'currencies', 'skills'));
        $this->set('_serialize', ['project']);

        if ($this->request->is('post')) {
  
            $project = $this->Projects->patchEntity($project, $this->request->data);
            
            $project->name = ucwords(strtolower($project->name));
            $project->date_human = date("l jS F, Y", strtotime("now")); 
            $project->user_id = $this->Auth->user('id');
            
            $this->loadComponent('slugcreator');
            $project->slug = $this->slugcreator->userslug($project->name);
            
            if(!empty($this->request->data['currency_id'])) {
            
              $this->loadModel('Currencies');
              $currencies = $this->Currencies
                ->find()
                ->where(['id' => $this->request->data['currency_id']])
                ->first();
         
               $project->denomination = $currencies->html_entity;
               $project->currency_abbrev = $currencies->name;
            }
            
            $project->status = 'Live';
            
            $project->projecttype = $type;
            $project->ownername = $this->Auth->user('name');
            $project->owneremail = $this->Auth->user('email');
            $projectslug =  $project->slug;
            $projecttitle = $project->name;
            
            $content = '';
            
            if(!empty($project->stage1)){
              $content = $project->stage1;
              $description = $this->cleanhtml($project->stage1);
              $project->stage1 = $description;
              $project->short_description = substr($description, 0, 200);
            }
            if(!empty($project->stage2)){
              $content = $content.$project->stage2;
              $project->stage2 = $this->cleanhtml($project->stage2);
            }
            if(!empty($project->stage3)){
              $content = $content.$project->stage3;
              $project->stage3 = $this->cleanhtml($project->stage3);
            }
            if(!empty($project->stage4)){
              $content = $content.$project->stage4;
              $project->stage4 = $this->cleanhtml($project->stage4);
            }

            
             
                                           
            if ($this->Projects->save($project)) {
            
            $id = $project->id;           
       
            $titlelink =  '<a href="www.skillbooker.com/projects/view/'.$projectslug.'">'.$projecttitle.'</a>';     
                
            $keys = array();
            $keys[] = $this->Auth->user('name');
            $keys[] = $titlelink;
            
            $sendvalues = array();
            $sendvalues['to'] = $this->Auth->user('email');
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 8;
            $sendvalues['receiver_id'] = $this->Auth->user('id');
            $sendvalues['sender_id'] = $user_id;
            $sendvalues['logreceived'] = 'received';
      
      if(SENDMAIL == 1) {
      
            // email to user from site inform of project listed
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues);
      }  

            if(!empty($content)){
              $this->scanprojectforskills($content, $project->id);
            }
  

                $this->Flash->success(__('The project has been saved, please add some skills to match freelancers with this project'));

                return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'skills', $project->slug]);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        
    }
    
    
    
        public function edit($slug = null)
    {

        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->viewBuilder()->layout('frontside');
        
        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $project = $project->first();

        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        if($project->currentbids > 0){
            $this->Flash->error(__('Sorry, this project can not be edited, people are bidding on it.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
        }
        
        $currencies = $this->Projects->Currencies->find('list', ['limit' => 200]);
        $this->set(compact('project', 'currencies', 'skills', 'projectskills'));
        $this->set('_serialize', ['project']);
        
        if($project->projecttype == 2) {
          $this->render('edithourly');
        } else {
         $this->render('edit');
        }

            if ($this->request->is(['patch', 'post', 'put'])) {

            $project = $this->Projects->patchEntity($project, $this->request->data);
            
            $project->name = ucwords(strtolower($project->name));
            $project->date_human = date("l jS F, Y", strtotime("now")); 
            $project->user_id = $this->Auth->user('id');
            
            if(!empty($this->request->data['currency_id'])) {
            
              $this->loadModel('Currencies');
              $currencies = $this->Currencies
                ->find()
                ->where(['id' => $this->request->data['currency_id']])
                ->first();
         
              $project->denomination = $currencies->html_entity;
              $project->currency_abbrev = $currencies->name;
  
            } 
            
            
            if(!empty($project->stage1)){
              $description = $this->cleanhtml($project->stage1);
              $project->stage1 = $description;
              $project->short_description = substr($description, 0, 200);
            }
            if(!empty($project->stage2)){
              $project->stage2 = $this->cleanhtml($project->stage2);
            }
            if(!empty($project->stage3)){
              $project->stage3 = $this->cleanhtml($project->stage3);
            }
            if(!empty($project->stage4)){
              $project->stage4 = $this->cleanhtml($project->stage4);
            }
            
            $project->status = 'Live';                        
                                 
            if ($this->Projects->save($project)) {
            
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
            }
            
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }

    }



    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($slug = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->request->allowMethod(['post', 'delete']);
        
        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $project = $project->first();      
        
        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        $Table = TableRegistry::get('Deletedprojects');
        $backup = $Table->newEntity();
       
          $backup->id = $project->id;
          $backup->name = $project->name;
          $backup->slug = $project->slug;
          $backup->industry_id = $project->industry_id;
          $backup->user_id = $project->user_id;
          $backup->ownername = $project->ownername;
          $backup->owneremail = $project->owneremail;
          $backup->awardedname = $project->awardedname;
          $backup->awardedemail = $project->awardedemail;
          $backup->awardeduser = $project->awardeduser;
          $backup->awardedamount = $project->awardedamount;
          $backup->projecttype = $project->projecttype;
          $backup->currency_id = $project->currency_id;
          $backup->denomination = $project->denomination;
          $backup->currency_abbrev = $project->currency_abbrev;
          $backup->amount = $project->amount;
          $backup->stage1 = $project->stage1;
          $backup->stage2 = $project->stage2;
          $backup->stage3 = $project->stage3;
          $backup->stage4 = $project->stage4;
          $backup->complete1 = $project->complete1;
          $backup->complete2 = $project->complete2;
          $backup->complete3 = $project->complete3;
          $backup->complete4 = $project->complete4;
          $backup->cost1 = $project->cost1;
          $backup->cost2 = $project->cost2;
          $backup->cost3 = $project->cost3;
          $backup->cost4 = $project->cost4;
          $backup->paid1 = $project->paid1;
          $backup->paid2 = $project->paid2;
          $backup->paid3 = $project->paid3;
          $backup->paid4 = $project->paid4;
          $backup->short_description = $project->short_description;
          $backup->twittercount = $project->twittercount;
          $backup->status = $project->status;
          $backup->currentbids = $project->currentbids;
          $backup->skills = $project->skills;
          $backup->date_human = $project->date_human;
          $backup->created = $project->created;
          $backup->modified = $project->modified;
          
          $Table->save($backup);
        
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'list']);
    }
    
    
      
      public function placebidmodal($slug = null)
    {
           
     $user_id = $this->Auth->user('id');    
     $this->viewBuilder()->layout('ajax'); 
    
      $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug]
        ]);
      $project = $project->first();
        
      if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
      }
      
      $userslug = $this->Auth->user('slug');
      $this->set('userslug', $userslug);
        
      $this->set('project', $project);
      
    }
    
      public function placebidaction()
    {
      if ($this->request->is(['patch', 'post', 'put'])) {
      
        if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
              $user_id = $this->Auth->user('id');
        }
        
        $canbid = $this->canbid();
        if(!$canbid) {
          $this->Flash->error(__('Sorry, you have to upgrade your subscription to at least General Jo.'));
          return $this->redirect(['plugin' => null, 'controller' => 'salesoptions', 'action' => 'freelancers']);

        } 
        
        $biddername = $this->Auth->user('name');
        $bidderslug = $this->Auth->user('slug');  
      
        $slug = $this->request->data['slug'];
        $amount = $this->request->data['bidamount']; 
        $reason = $this->request->data['reason'];
                                                           
        $project = $this->Projects->find('all', [ 
            'conditions' => ['slug' => $slug]
          ]);
        $project = $project->first();
      
        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project doesnt exist.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        if($project->user_id == $user_id){
            $this->Flash->error(__('Sorry, you can not bid on your own project.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        $this->loadModel('Bids');
        $bids = $this->Bids->find('all', [ 
          'conditions' => ['project_id' => $project->id, 'user_id' => $user_id,]
        ]);
        $bids = $bids->first();
        
        if(!empty($bids->id)){
            $this->Flash->error(__('Sorry, You have already made a bid on this project.'));
            //return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
            //return $this->redirect($this->here);
           // current page
           return $this->redirect($this->referer());
        }
        
        $Table_u = TableRegistry::get('Projects');
        $update = $Table_u->get($project->id);
        $projecttitle = $update->name;
        $owner_id = $update->user_id;
        $ownername = $update->ownername;
        $owneremail = $update->owneremail;
        
        $currentbid = $project->currentbids; 
        $update->currentbids = $currentbid + 1;
        $Table_u->save($update);

        
        $Table = TableRegistry::get('Bids');
        $insert = $Table->newEntity();
        
        $insert->project_id = $project->id;
        $insert->user_id = $user_id;
        $insert->owner_id = $project->user_id;
        $insert->denomination = $project->denomination;
        $insert->amount = $amount;
        $insert->reason = $reason;
        $insert->status = 'Submitted';
        $insert->created = date("Y-m-d H:i:s");
        $insert->modified = date("Y-m-d H:i:s");              
        
                
        if ($Table->save($insert)) {
            
              $titlelink =  '<a href="www.skillbooker.com/online/cv/'.$bidderslug.'">'.$biddername.'</a>';
              $keys = array();
              $keys[] = $ownername;
              $keys[] = $titlelink;
              $keys[] = $reason;
              
              $sendvalues = array();
              $sendvalues['to'] = $owneremail;
              $sendvalues['keys'] = $keys;
              $sendvalues['subject'] = $biddername.' has placed a bid on your project';
              $sendvalues['templateid'] = 14;
              $sendvalues['receiver_id'] = $owner_id;
              $sendvalues['logreceived'] = 'received';
              $sendvalues['sender_id'] = $user_id;
              $sendvalues['logsent'] = 'sent';
  
        if(SENDMAIL == 1) {
              // from site to project owner inform of bid that was placed
              $this->loadComponent('Emailc');                  
              $emailc = $this->Emailc->send_email($sendvalues); 
        }     
              
            $this->Flash->success(__('Your bid has been submitted, the owner has been informed if you are chosen you will be contacted.'));
            return $this->redirect($this->referer());
        }

      }
    }
    
      public function addextrahoursModal($slug = null)
    {
      
      
      $user_id = $this->Auth->user('id');  
      $this->viewBuilder()->layout('ajax');
    
      $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id, 'projecttype' => 2]
        ]);
      $project = $project->first();
        
      if(empty($project->id)){
            $this->Flash->error(__('Sorry, there was an error please contact support'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
      }
        
      $this->set('project', $project);

      $this->loadModel('Users');
      $freelancer = $this->Users->find('all', [ 
          'conditions' => ['id' => $project->awardeduser]
      ]);
      $freelancer = $freelancer->first();
      
      $this->set('freelancer', $freelancer);
      
    }

      public function addextrahoursAction()
    {
      if ($this->request->is(['patch', 'post', 'put'])) {
      
        if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
              $user_id = $this->Auth->user('id');
        }  
          
      
        $slug = $this->request->data['slug'];
        $extra = $this->request->data['extrahours'];
        $notes = $this->request->data['notes']; 
      
        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id, 'projecttype' => 2]
          ]);
        $project = $project->first();
        $projectslug =  $project->slug;
        $projecttitle = $project->name;
        $awardedname = $project->awardedname;
        $awardedemail = $project->awardedemail;
        $owner_id = $project->user_id;
        $awarded_id = $project->awardeduser;
      
        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project doesnt exist.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        $amount = $project->awardedamount;
        $cost = $extra * $amount;
      
        $Table = TableRegistry::get('Extrahours');
        $insert = $Table->newEntity();
        
        $insert->project_id = $project->id;
        $insert->slug = $project->slug;
        $insert->user_id = $user_id;
        $insert->freelancer = $project->awardeduser;
        $insert->denomination = $project->denomination;
        $insert->currency_abbrev = $project->currency_abbrev;
        $insert->cost = $cost;
        $insert->notes = $notes;
        $insert->hours = $extra;
        $insert->created = date("Y-m-d H:i:s");
        $insert->modified = date("Y-m-d H:i:s"); 
        
        if ($Table->save($insert)) {
                
            $titlelink =  '<a href="www.skillbooker.com/projects/view/'.$projectslug.'">'.$projecttitle.'</a>';
            $keys = array();
            $keys[] = $awardedname;
            $keys[] = $titlelink;
            
            $sendvalues = array();
            $sendvalues['to'] = $awardedemail;
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 10;
            $sendvalues['receiver_id'] = $awarded_id;
            $sendvalues['sender_id'] = $owner_id;
            $sendvalues['logreceived'] = 'received';
            $sendvalues['logsent'] = 'sent';

      if(SENDMAIL == 1) {
            // from site to freelancer inform that project owner has added extra hours
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues); 
      }
            
            $this->Flash->success(__('Extra hours had been added for this project.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$slug]);
        } 
                  

      }
    }

    
  public function ratebidModal($id){

    $this->viewBuilder()->layout('ajax');

    $user_id = $this->Auth->user('id'); 
    
    $this->loadModel('Bids');
    $bids = $this->Bids->find('all', [ 
          'conditions' => ['id' => $id, 'owner_id' => $user_id, 'status' => 'Submitted']
    ]);
    $bids = $bids->first();
    
    $this->set('bids', $bids);
    
	}
  
   public function rateaction(){
  
        if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
              $user_id = $this->Auth->user('id');
        }  
        //dd($this->request->data);
        
        if ($this->request->is(['patch', 'post', 'put'])) {  

          $bid_id = $this->request->data['id'];
          $rating = $this->request->data['rating'];
          
          $Table = TableRegistry::get('Bids');
          $update = $Table->get($bid_id);
          $project_id = $update->project_id;
          
          $update->rating = $rating;
          if($Table->save($update)) {
          
          $PTable = TableRegistry::get('Projects');
          $project = $PTable->get($project_id);
          
            $this->Flash->success(__('You have updated a rating.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'bids',$project->slug]);
          } 
        
        }
        
	} 
  
  
      public function removebid($id = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $Table = TableRegistry::get('Bids');
        $update = $Table->get($id); 
        
        $project_id = $update->project_id;
        $bids = $update->bids;
        
        $updateTable = TableRegistry::get('Projects');
        $project = $updateTable->get($project_id); 
        
        $project->currentbids = $bids - 1;
        $updateTable->save($project);
        
        $update->status = 'Rejected';

        if ($Table->save($update)) {
            $this->Flash->success(__('The bid has been deleted.'));
        } else {
            $this->Flash->error(__('The bid could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'bids']);
    } 



       public function allocate($id)
    {
      $this->viewBuilder()->layout('ajax');   
          
      $user_id = $this->Auth->user('id');
      
      $this->loadModel('Bids');
      $bids = $this->Bids->find('all', [ 
          'conditions' => ['id' => $id, 'owner_id' => $user_id]
        ]);
      $bids = $bids->first();
      
      //debug($bids);
      $this->set('bids', $bids); 
         
      $project = $this->Projects->find('all', [ 
          'conditions' => ['id' => $bids->project_id]
        ]);
      $project = $project->first();
      
      $this->set('project', $project);            

           // debug($project);
            
      $this->loadModel('Users');  
      $user = $this->Users->find('all', [ 
          'conditions' => ['id' => $bids->user_id]
        ]);
      $user = $user->first();
      
                 // debug($user);
 
      $this->set('user', $user);
    }
    
       public function allocateaction(){
  
        if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
              $user_id = $this->Auth->user('id');
        }  

        if ($this->request->is(['patch', 'post', 'put'])) {  

          $bid_id = $this->request->data['id'];
          $slug = $this->request->data['slug'];
          
          $project = $this->Projects->find('all', [ 
              'conditions' => ['slug' => $slug, 'user_id' => $user_id]
            ]);
          $project = $project->first();
          
          $projectslug =  $project->slug;
          $projecttitle = $project->name;
          $stageinterval = $project->stageinterval;
          $projecttype = $project->projecttype;

          $this->loadModel('Bids');
          $updateall = $this->Bids->updateAll(
            [  // fields
                'status' => 'Rejected'
            ],
            [  // conditions
                'project_id' => $project->id,
                'owner_id' => $user_id,
                'id <> ' => $bid_id
                
            ]
          );
          

            $Table = TableRegistry::get('Bids');
            $update = $Table->get($bid_id);
            
            $awardeduser = $update->user_id;
            $awardedamount = $update->amount;
  
            $update->status = 'Awarded';
            $Table->save($update);
            
            $this->loadModel('Users');
            $awarded = $this->Users->find('all', [ 
                'conditions' => ['id' => $awardeduser]
              ]);
            $awarded = $awarded->first();
            
            $awardedname = $awarded->name;
            $awardedemail = $awarded->email;
          
            $projectTable = TableRegistry::get('Projects');
            $projectupdate = $projectTable->get($project->id);
  
            $projectupdate->status = 'Awarded';
            $projectupdate->awardeduser = $awardeduser;
            $projectupdate->awardedamount = $awardedamount;
            $projectupdate->awardedname = $awardedname;
            $projectupdate->awardedemail = $awardedemail;

            $cost = $awardedamount/$stageinterval;
            
            if($stageinterval == 1){ $projectupdate->cost1 = $cost; }
            if($stageinterval == 2){ $projectupdate->cost1 = $cost; $projectupdate->cost2 = $cost; }
            if($stageinterval == 3){ $projectupdate->cost1 = $cost; $projectupdate->cost2 = $cost; $projectupdate->cost3 = $cost; }
            if($stageinterval == 4){ $projectupdate->cost1 = $cost; $projectupdate->cost2 = $cost; $projectupdate->cost3 = $cost; $projectupdate->cost4 = $cost; }

            if($projecttype == 2) {
             $hours = $update->numberhours; 
             $timeshours = $cost * $hours;
             $projectupdate->cost1 = $timeshours;
            }
        
        if($projectTable->save($projectupdate)) {
          
            $titlelink =  '<a href="www.skillbooker.com/projects/view/'.$projectslug.'">'.$projecttitle.'</a>';
            
            $keys = array();
            $keys[] = $awardedname;
            $keys[] = $titlelink;
            
            $sendvalues = array();
            $sendvalues['to'] = $awardedemail;
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 9;
            $sendvalues['receiver_id'] = $awardeduser;
            $sendvalues['sender_id'] = $user_id;
            $sendvalues['logreceived'] = 'received';
            $sendvalues['logsent'] = 'sent';

        if(SENDMAIL == 1) {
            // from site: owner award project to freelancer
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues);
        } 
                                  
            $this->Flash->success(__('Congratulations! You have allocated your project.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress', $projectslug]);            
        } else {
            $this->Flash->error(__('Sorry! You could not allocated your project.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
        }
          
        } 
        
	} 
  
  
      public function inserttemplatemodal($id = null)
    {
        if(empty($id)) { $id = 1; } else { $id = 2; }
        
        $this->viewBuilder()->layout('ajax'); 
        $this->loadModel('ProjectTemplates');
        $templates = $this->ProjectTemplates->find('all', [
          'fields' => ['slug', 'name'],
          'conditions' => ['projecttype' => $id]
        ]);
        
        $templates = $templates->toList();

        $this->set('templates', $templates);
        $this->set('id', $id);
    }
  
      public function inserttemplateaction()
    {
      if ($this->request->is(['patch', 'post', 'put'])) {
       
        $slug = $this->request->data['template'];
        $id = $this->request->data['id'];
              

        $this->Flash->success(__('The project has been populated.'));
        
        if($id == 2) {
          return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'addhourly', $slug]);
        } else {
          return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'add', $slug]);
        }

      }
    }

        public function progress($slug = null)
    {
    
        $this->viewBuilder()->layout('frontside');
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $project = $project->first();

        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        if( ($project->status == 'Awarded') || ($project->status == 'Completed') ) { } else {
            $this->Flash->error(__('Sorry, this project has to be awarded first.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
        }
        
         $this->set('project', $project);
         
          $this->loadModel('Notes');
          $notes = $this->Notes->find('all', [ 
            'conditions' => ['user_id' => $user_id, 'project_id' => $project->id]
          ]);
          
          $this->set('notes', $notes);
         
        if($project->projecttype == 2) {
        
          $this->loadModel('Extrahours');
          $extrahours = $this->Extrahours->find('all', [ 
            'conditions' => ['user_id' => $user_id, 'project_id' => $project->id]
          ]);
          
          $this->set('extrahours', $extrahours);
        
          $this->render('progresshourly');
        } else {
         $this->render('progress');
        }
    }
    
      public function setprogressmodal($slug = null)
    {
    
        $user_id = $this->Auth->user('id');

        $project = $this->Projects->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $project = $project->first();

        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        $this->viewBuilder()->layout('ajax');
        
        if($project->complete1 != 100){
            $complete = 1;
            $percentage = $project->complete1;
        } elseif($project->complete2 != 100){
           $complete = 2;
           $percentage = $project->complete2;
        } elseif($project->complete3 != 100){
           $complete = 3;
           $percentage = $project->complete3;
        }
        elseif($project->complete4 != 100){
           $complete = 4;
           $percentage = $project->complete4;
        } else {

        }

          $this->set('percentage', $percentage);
          $this->set('complete', $complete);
          $this->set('project', $project);
    }
    
      public function setprogressaction(){
  
        if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
              $user_id = $this->Auth->user('id');
        }  

        if ($this->request->is(['patch', 'post', 'put'])) {  

          $stageid = $this->request->data['stage'];
          $slug = $this->request->data['slug'];
          $progress = $this->request->data['progress'];
          
          $project = $this->Projects->find('all', [ 
              'conditions' => ['user_id' => $user_id, 'slug' => $slug, 'status' => 'Awarded']
            ]);
          $project = $project->first();
          
          $projectslug =  $project->slug;
          $projecttitle = $project->name;
          $awardeduser = $project->awardeduser;
          
        $Table = TableRegistry::get('Projects');
        $update = $Table->get($project->id);
        
        $awardedname = $update->awardedname;
        $awardedemail = $update->awardedemail;
  
        if($stageid == 1) { $update->complete1 = $progress; }
        if($stageid == 2) { $update->complete2 = $progress; }
        if($stageid == 3) { $update->complete3 = $progress; }
        if($stageid == 4) { $update->complete4 = $progress; }
        
          if($Table->save($update)) {
                    
            $titlelink =  '<a href="www.skillbooker.com/projects/view/'.$projectslug.'">'.$projecttitle.'</a>';
            $keys = array();
            $keys[] = $awardedname;
            $keys[] = $titlelink;
            
            $sendvalues = array();
            $sendvalues['to'] = $awardedemail;
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 11;
            $sendvalues['receiver_id'] = $awardeduser;
            $sendvalues['sender_id'] = $user_id;
            $sendvalues['logreceived'] = 'received';
            $sendvalues['logsent'] = 'sent';


        if(SENDMAIL == 1) {
            // from site: owner set progress on project inform freelancer
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues); 
        }    
                       
              $this->Flash->success(__('Progress on stage '.$stageid.' has been updated'));
              return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress', $slug]);            
          } else {
              $this->Flash->error(__('Sorry! we could not update your project progress.'));
              return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress', $slug]);
          }
          
        } 
        
	} 
  
  
      public function extrahourprogressModal($values = null)
    {
    
        $explode = explode('$',$values);
        $slug = $explode['0'];
        $id = $explode['1'];
        
        //dd($slug);
        
        $user_id = $this->Auth->user('id');

        $this->loadModel('Extrahours');
        $extrahours = $this->Extrahours->find('all', [ 
            'conditions' => ['id' => $id, 'user_id' => $user_id, 'slug' => $slug]
        ]);
        
        $extrahours = $extrahours->first();

        if(empty($extrahours->id)){
            $this->Flash->error(__('Sorry, there was an error.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$slug]);
        }
        
        $this->viewBuilder()->layout('ajax');
        
        if($extrahours->completed <> 100){
            $percentage = $extrahours->completed;
        }

          $this->set('percentage', $percentage);
          $this->set('values', $values);
    }
    
    
          public function extrahourprogressAction(){
  
        if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
              $user_id = $this->Auth->user('id');
        }  

        if ($this->request->is(['patch', 'post', 'put'])) {  

          $values = $this->request->data['slug'];
          $progress = $this->request->data['progress'];
          
          $explode = explode('$',$values);
          $slug = $explode['0'];
          $id = $explode['1'];
            
          $this->loadModel('Extrahours');
          $extrahours = $this->Extrahours->find('all', [ 
              'conditions' => ['id' => $id, 'user_id' => $user_id, 'slug' => $slug]
          ]);
        
          $extrahours = $extrahours->first();
          $project_id = $extrahours->project_id;
          
          $Table = TableRegistry::get('Extrahours');
          $update = $Table->get($extrahours->id);
    
          $update->completed = $progress; 
        
          if($Table->save($update)) {
          
          $Table = TableRegistry::get('Projects');
          $project = $Table->get($project_id);
          
          $projectslug = $project->slug;
          $projecttitle = $project->name;
          $awardeduser = $project->awardeduser; 
          $awardedname = $project->awardedname;
          $awardedemail = $project->awardedemail;
            

            $titlelink =  '<a href="www.skillbooker.com/projects/view/'.$projectslug.'">'.$projecttitle.'</a>';
            $keys = array();
            $keys[] = $awardedname;
            $keys[] = $titlelink;
            
            $sendvalues = array();
            $sendvalues['to'] = $awardedemail;
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 12;
            $sendvalues['receiver_id'] = $awardeduser;
            $sendvalues['sender_id'] = $user_id;
            $sendvalues['logreceived'] = 'received';
            $sendvalues['logsent'] = 'sent';

      if(SENDMAIL == 1) {
            // set progress on extra hours owner inform freelancer
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues); 
       }     
                                 
              $this->Flash->success(__('Progress on work has been updated'));
              return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$slug]);            
          } else {
              $this->Flash->error(__('Sorry! we could not update the progress.'));
              return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$slug]);
          }
          
        } 
        
	} 
  
        public function addnotesModal($slug = null)
    {    
        
        $this->viewBuilder()->layout('ajax');

        $this->set('slug', $slug);

    }
    
      public function addnotesAction()
    {    
        
        if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
              $user_id = $this->Auth->user('id');
        }  

        if ($this->request->is(['patch', 'post', 'put'])) {  

          $slug = $this->request->data['slug'];
          $notes = $this->request->data['notes'];
            
          $this->loadModel('Projects');
          $project = $this->Projects->find('all', [ 
              'conditions' => ['user_id' => $user_id, 'slug' => $slug]
          ]);
        
          $project = $project->first();
          $projectslug = $project->slug;
          $projecttitle = $project->name;
          $awardeduser = $project->awardeduser;
          $awardedusername = $project->awardedname;
          $awardeduseremail = $project->awardedemail; 
          
          if(empty($project->id)){
            $this->Flash->error(__('Sorry,we can not find your project'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$slug]);
          }
          
            $Table = TableRegistry::get('Notes');
            $insert = $Table->newEntity();
            
            $insert->project_id = $project->id;
            $insert->user_id = $user_id;
            $insert->slug = $project->slug;
            $insert->notes = $notes;
            $insert->created = date("Y-m-d H:i:s");
            $insert->modified = date("Y-m-d H:i:s");              
            
                    
          if ($Table->save($insert)) {
            
              $titlelink =  '<a href="www.skillbooker.com/projects/view/'.$projectslug.'">'.$projecttitle.'</a>';
              $keys = array();
              $keys[] = $awardedname;
              $keys[] = $titlelink;
              
              $sendvalues = array();
              $sendvalues['to'] = $awardedemail;
              $sendvalues['keys'] = $keys;
              $sendvalues['templateid'] = 13;
              $sendvalues['receiver_id'] = $awardeduser;
              $sendvalues['sender_id'] = $user_id;
              $sendvalues['logreceived'] = 'received';
              $sendvalues['logsent'] = 'sent';
  
        if(SENDMAIL == 1) {
              // from site: owner informs freelancer of notes on project
              $this->loadComponent('Emailc');                  
              $emailc = $this->Emailc->send_email($sendvalues); 
        }    
                                
              $this->Flash->success(__('Your note has been saved'));
              return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$slug]);            
          } else {
              $this->Flash->error(__('Sorry! we could not save the note.'));
              return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$slug]);
          }

    }
  }
  
  
          public function editnotesModal($id = null)
    {    
        
        $this->viewBuilder()->layout('ajax');

        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->loadModel('Notes');
        $note = $this->Notes->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $note = $note->first();
        $this->set('note', $note);

    }
    
      public function editnotesAction()
    {    
        
        if(is_null($this->Auth->user('id'))) {
              $this->Flash->error(__('Please login to access this page.'));
              return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
              $user_id = $this->Auth->user('id');
        }  

        if ($this->request->is(['patch', 'post', 'put'])) {  

          $id = $this->request->data['id'];
          $updatenote = $this->request->data['notes'];
            
          $this->loadModel('Notes');
          $note = $this->Notes->find('all', [ 
            'conditions' => ['id' => $id, 'user_id' => $user_id]
          ]);
          $note = $note->first();
          
          if(empty($note->id)){
            $this->Flash->error(__('Sorry,we can not find your note'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$note->slug]);
          }

            $Table = TableRegistry::get('Notes');
            $update = $Table->get($note->id);

            $update->notes = $updatenote;
            $update->modified = date("Y-m-d H:i:s");              
            
                    
          if ($Table->save($update)) {                    
              $this->Flash->success(__('Your note has been updated'));
              return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$note->slug]);            
          } else {
              $this->Flash->error(__('Sorry! we could not save the note.'));
              return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$note->slug]);
          }

    }
  }


  
          public function deletenote($id = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->request->allowMethod(['post', 'delete']);
        
        
        $this->loadModel('Notes');
        $note = $this->Notes->find('all', [ 
          'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        $note = $note->first();
        
        if(empty($note->id)){
            $this->Flash->error(__('Sorry, there is not note with this details.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
        }
        
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$note->slug]);
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
        
      if(empty($slug)) {
          $this->Flash->error(__('Sorry there seems to be an error.'));
          return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
      }
      
      $project = $this->Projects->find('all',['conditions'=>['Projects.slug'=>$slug, 'Projects.user_id'=>$user_id]]);
      $project = $project->first();
      $id = $project->id;
        
        if ($this->request->is('post')) {
        
        $this->loadModel('Projectskills');       
        $this->Projectskills->deleteAll(['project_id' => $id]);
        
        $this->loadModel('Skills');
        
        $commaskilllist = '';

        if(!empty($this->request->data['skill_id'])) {
        foreach($this->request->data['skill_id'] as $key => $val){
   
             if(($val <> '') && ($val <> 0) ) {
               
                  $sk = $this->Skills->find('all', ['conditions' => ['id' => $val]])->first();
           
          				$skillsTable = TableRegistry::get('Projectskills');
                  $projectskills = $skillsTable->newEntity();
                  
     							$projectskills->project_id = $id;
    							$projectskills->skill_id = $sk->id;
                  $projectskills->skill_name		=	$sk->name;
    					    $projectskills->slug		=	$sk->slug;
                  $projectskills->industry_id	=	$sk->industry_id;
                  $projectskills->created	=	date('Y-m-d');
                  
                  $skillsTable->save($projectskills);
                  
                  $commaskilllist .= $sk->name.',';
                       
              }
          }
          }
          
            
            if(!empty($this->request->data['skilllist'])) {
              
              $skilllist = $this->request->data['skilllist'];
              $explode_skills = explode(',',$skilllist);
              
                  
               /*   
                  foreach($explode_skills as $newskill){
                  
                    $Table = TableRegistry::get('Projectskills');
                    $addskills = $Table->newEntity();
                    
       							$addskills->project_id = $id;
      							$addskills->skill_id = '9999999';
                    $addskills->skill_name		=	$newskill;
      					    $addskills->slug = $newskill;
                    $addskills->industry_id	=	20;
                    $addskills->created	=	date('Y-m-d');
                    
                    $Table->save($addskills);
                  
                  }
              */    
                  
              $commaskilllist = $commaskilllist.$skilllist;
                
              $keys = array();
              $keys[] = $skilllist;
              $keys[] = $slug;
              
              $sendvalues = array();
              $sendvalues['to'] = 'contact@skillbooker.com';
              $sendvalues['keys'] = $keys;
              $sendvalues['templateid'] = 15;
      
              if(SENDMAIL == 1) {              
                  $this->loadComponent('Emailc');                  
                  $emailc = $this->Emailc->send_email($sendvalues);
              }
            
            }
          
                $commaskilllist = rtrim($commaskilllist,',');
                
                $Table = TableRegistry::get('Projects');
                $update = $Table->get($id);
                $update->skills = $commaskilllist;
                $Table->save($update);
          
           $this->Flash->success(__('The Skills for this project has been updated.'));
           return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
        }
        

          $this->loadModel('Skills');
          $skills = $this->Skills
            ->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->toArray();
            
          $this->loadModel('Projectskills');
          $projectskills = $this->Projectskills
            ->find('list', ['keyField' => 'skill_id', 'valueField' => 'skill_name'])
            ->where(['project_id' => $project->id])
            ->toArray();
          
        
        $this->set(compact('project', 'skills', 'projectskills'));
        $this->set('_serialize', ['jobs']);
    }
    
    
    
           public function scanprojectforskills($content, $id)
    {   

          $this->loadComponent('Filereader');                  
            
            $Tableskills = TableRegistry::get('Skills');
            $skills = $Tableskills->find('all');	
              
         
								foreach($skills as $skill) {                         			
            										                  
                    $tempobject = $this->Filereader->searchwordlowercase($content,$skill->slug);

										if(!empty($tempobject)) { 
                    
                      $Table_us = TableRegistry::get('Projectskills');
											$skill_entry = $Table_us->find('all',['conditions'=>['project_id' => $id, 'slug'=>$skill->slug]]);
                      $entrycount = $skill_entry->count();
                        
                      if($entrycount < 1) {
                      
                        $addskill = $Table_us->newEntity();
                        
                        $addskill->project_id		=	$id;
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

function canbid(){

    $subscription = $this->request->session()->read('Auth.User.subscription');
    $subscriptiondate = $this->request->session()->read('Auth.User.subscriptiondate');
                    
    if($subscription == 'Entry') {
      return false;
    } else {
      if(strtotime($subscriptiondate) > strtotime('-1 year')) {
       return true;
      } else {
      return false;
      }
    }
}
    
     
function cleanhtml($text){

    $text = str_replace("<p>&nbsp;</p>", "", $text); 
    $find =  array("justify", "Verdana, sans-serif", " style=", "font-size", "font-family", "mso-ansi-language", "mso-bidi-font-size", "EN-US", "<div>" , "</div>" , "<div " , "</div " ,  "class=" , "<!--" , "<xml>" , "<w:", "-->", "'", "<?", "<table", "<Table", "<TABLE", "<ta", "<TA", "MsoHeader", "0cm" , "0pt" , "margin", "text-indent", "MsoNormal", "0in", "tab-stops", "Arial", "mso-bidi", " pt ", "mso-list", "Times New Roman", "mso-spacerun", "lang=", "x-small", "id=", "line-height: ", "align=", "text-align:", "<h1", "</h1>", "\r" , "\n");
    $text = trim($text);
    $text = str_replace($find, ' ', $text);
    $text = str_replace('"', '&#39;', $text);
    $text = str_replace("'", "&#39;", $text); 
    $text = stripslashes($text);
    //$text = strip_tags($text);
    //$text = htmlspecialchars($var,ENT_QUOTES);
    
      
      return $text;

}

}