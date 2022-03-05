<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class TutorialsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
          $this->Auth->allow();
        
        $this->viewBuilder()->layout('front');
        $this->set('setstate', 'tutorials');
        
        $this->set('pagetitle', 'Skillbooker.com - Tutorials');
        $this->set('taglist', 'Tutorials');
        $this->set('pagedescription', 'Skillbooker.com -  Tutorials'); 

    }
    
    public function isAuthorized($user)
    {       
         return parent::isAuthorized($user);
    }



    
    
    public function index($slug=null) {
      
      if($slug == null) {
      $query =  $this->Tutorials->find('all', ['conditions'=>['Tutorials.status' => 1], 'order'=>['Tutorials.id' => 'DESC']]);                                             
      } else {
      $query = $this->Tutorials->find('all',['conditions'=>['Tutorials.slug' => $slug], 'order'=>['Tutorials.id' => 'DESC']]);
      }
      $tutorial = $query->first();
      
      $tutorial->hitcount = $tutorial->hitcount + 1;
      $this->Tutorials->save($tutorial);
      
      $tutorials = $this->Tutorials->find('all',['conditions'=>['Tutorials.tutorial_category_id' => $tutorial['tutorial_category_id'], 'Tutorials.status' => 1, 'Tutorials.id <> ' => $tutorial['id']], 'order'=>['Tutorials.id' => 'DESC']]);
      
      $this->loadModel('TutorialCategories');
      $query =  $this->TutorialCategories->find('all',['conditions'=>['TutorialCategories.id' => $tutorial['tutorial_category_id']]]);
      $currentcategory= $query->first();
     
      $categories =  $this->TutorialCategories->find('all', ['order'=>['TutorialCategories.rank' => 'ASC']]);
      
      $this->loadModel('TutorialSkills');
      $skills =  $this->TutorialSkills->find('all', ['conditions'=>['TutorialSkills.tutorial_id' => $tutorial['id']]]);
      
      $this->loadModel('TutorialComments');
      $comments = $this->TutorialComments->find('all', [
            'fields' => ['child.id',  'child.is_parent', 'child.is_child', 'child.comment',  'child.created', 'child.user_id', 'child.username', 'child.userslug', 'child.useravatar', 'TutorialComments.id',  'TutorialComments.is_parent', 'TutorialComments.is_child', 'TutorialComments.comment',  'TutorialComments.created', 'TutorialComments.user_id', 'TutorialComments.username', 'TutorialComments.userslug', 'TutorialComments.useravatar'],
            'conditions' => [['TutorialComments.tutorial_id' => $tutorial['id']], ['TutorialComments.is_parent' => 1]],
              'join' => [                           
                  'child' => [
                                'table' => 'tutorial_comments',
                                'type' => 'LEFT',
                                'conditions' => 'TutorialComments.id = child.parent_id AND child.is_child = 1'
                              ]
                  
               ],
                //'group' => 'TutorialComments.id',
                'order' => ['TutorialComments.id DESC'] 
        ]); 
                                
      
      $taglist = '';
      foreach($skills as $key => $value) {
      $taglist .= $value->skill_name.',';
      } 

      $this->set('pagetitle', $tutorial->name);
      $this->set('pagedescription', $tutorial->name);
      $this->set('taglist', $taglist); 
      
      $this->set(compact('tutorial', 'tutorials', 'categories', 'currentcategory', 'skills', 'comments'));

    	   	                             
    }

    
    public function category($slug=null) {
    
              
      $this->loadModel('TutorialCategories');
      if($slug == null) {} else {
      $query =  $this->TutorialCategories->find('all',['conditions'=>['TutorialCategories.slug' => $slug]]);
      $currentcategory= $query->first();
      }     
      
      $query = $this->Tutorials->find('all',['conditions'=>['Tutorials.tutorial_category_id' =>$currentcategory->id], 'order'=>['Tutorials.id' => 'DESC']]);
      $tutorial = $query->first();
      
      $tutorial->hitcount = $tutorial->hitcount + 1;
      $this->Tutorials->save($tutorial);
      
      $tutorials = $this->Tutorials->find('all',['conditions'=>['Tutorials.tutorial_category_id' => $currentcategory->id, 'Tutorials.status' => 1, 'Tutorials.id <> ' => $tutorial['id']], 'order'=>['Tutorials.id' => 'DESC']]);
     
      $categories =  $this->TutorialCategories->find('all', ['order'=>['TutorialCategories.rank' => 'ASC']]);
      
      $this->loadModel('TutorialSkills');
      $skills =  $this->TutorialSkills->find('all', ['conditions'=>['TutorialSkills.tutorial_id' => $tutorial['id']]]);
      
      $this->loadModel('TutorialComments');
      $comments = $this->TutorialComments->find('all', [
            'fields' => ['child.id',  'child.is_parent', 'child.is_child', 'child.comment',  'child.created', 'child.user_id', 'child.username', 'child.userslug', 'child.useravatar', 'TutorialComments.id',  'TutorialComments.is_parent', 'TutorialComments.is_child', 'TutorialComments.comment',  'TutorialComments.created', 'TutorialComments.user_id', 'TutorialComments.username', 'TutorialComments.userslug', 'TutorialComments.useravatar'],
            'conditions' => [['TutorialComments.tutorial_id' => $tutorial['id']], ['TutorialComments.is_parent' => 1]],
              'join' => [                           
                  'child' => [
                                'table' => 'tutorial_comments',
                                'type' => 'LEFT',
                                'conditions' => 'TutorialComments.id = child.parent_id AND child.is_child = 1'
                              ]
                  
               ],
                //'group' => 'TutorialComments.id',
                'order' => ['TutorialComments.id DESC'] 
        ]);
        
      $taglist = '';
      foreach($skills as $key => $value) {
      $taglist .= $value->skill_name.',';
      } 
      
      $this->set('pagedescription', $tutorial->name);
      $this->set('taglist', $taglist); 
         
      $this->set(compact('tutorial', 'tutorials', 'categories', 'currentcategory', 'skills', 'comments'));
      
      $this->render('index');
    }
    
    
      public function list() {
    
              
          if ($this->request->is('post')) {

              $search = '%'.$this->request->data['search'].'%';
              $dosearch = $this->request->data['dosearch'];
    
              if($dosearch == 'do') {
      
                  $tutorials = $this->Tutorials->find('all',[
                      'conditions'=>['OR' => ['Tutorials.name LIKE' => $search, 'tutorial_skills.slug LIKE' => $search]],
                      'join' => [  
                          [
                            'table' => 'tutorial_skills',
                            'alias' => 'tutorial_skills',
                            'type' => 'LEFT',
                            'conditions' => [
                             'tutorial_skills.tutorial_id = Tutorials.id'
                            ]
                          ],
                        ],
                      'group' => 'Tutorials.id',
                      ]);

                  $number = $tutorials->count();
                   if($number < 1) {
                   
                        $this->Flash->error(__('We have found no results on that search term.'));    
                   
                        $tutorials = $this->Tutorials->find('all');
                   }
           
               }
               
          } else {
              $tutorials = $this->Tutorials->find('all');
          }

          $this->loadModel('TutorialCategories');
          $categories =  $this->TutorialCategories->find('all', ['order'=>['TutorialCategories.rank' => 'ASC']]);

          $this->set('pagedescription', 'list of tutorials on Skillbooker.com');
          
          $tutorials = $this->paginate($tutorials);
  
          $this->set(compact('tutorials', 'categories'));
          $this->set('_serialize', ['tutorials']); 
           

      
    }
    
    
    
    public function search($slug=null) {
      
      if($slug == null) {
        $this->Flash->success(__('Your search criteria is empty.'));
        return $this->redirect(['controller' => 'tutorials', 'action' => 'index']);
      }
      
      $this->loadModel('TutorialCategories');
      $categories =  $this->TutorialCategories->find('all', ['order'=>['TutorialCategories.rank' => 'ASC']]); 
            
      $this->loadModel('TutorialSkills');
      $tutorialskills =  $this->TutorialSkills->find('all', ['conditions'=>['TutorialSkills.slug' => $slug], 'fields' => ['TutorialSkills.tutorial_id']]);

      $tutorialids = '';
      foreach($tutorialskills as $key => $value) {
       $tutorialids .= $value->tutorial_id.',';
      }
     
      $tutorialids = rtrim($tutorialids, ','); 

      $tutorials = $this->Tutorials->find('all',['conditions'=>['Tutorials.id IN ('.$tutorialids.')', 'Tutorials.status' => 1]]);
      
      $this->set(compact('tutorials', 'categories'));

    	$this->set('pagedescription', 'IT tutorials for beginners and experts');	   
    }
    
       public function pages($slug=null) {
      
      if($slug == null) {
        $this->Flash->success(__('Your search criteria is empty.'));
        return $this->redirect(['controller' => 'tutorials', 'action' => 'index']);
      }
      
      $this->render($slug);
     
    }
}