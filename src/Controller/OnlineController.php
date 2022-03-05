<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class OnlineController extends AppController
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

    }
    
    public function isAuthorized($user)
    {
    
        if (isset($user['role_id']) && $user['role_id'] == '1') {
            return true;             
        }
        
         return parent::isAuthorized($user);
    }
    
     
	function cv($slug) {
  
  
    if (empty($slug)) { 
          $this->Flash->error(__('Oops run into an big bo-bo.'));
          return $this->redirect(['plugin' => null, 'controller' => 'pages', 'action' => 'welcome']);      
    }
   
    $this->loadModel('Users');
    $user = $this->Users->find('all',['conditions'=> ['Users.slug'=>$slug]]);
    $user = $user->first();
    $this->set('user', $user);
    $user_id = $user->id;
    
    $this->loadModel('Candidates');  
    $candidate = $this->Candidates->find('all',[
    'conditions'=>['Candidates.user_id'=>$user_id],
    ]);
    $candidate = $candidate->first();
    
    $this->loadComponent('Availabilitycalendar');
    
    $now = new \DateTime('now');
    $currentmonth = $now->format('m');
    $year = $now->format('Y');
    
    $calendar1 = $this->Availabilitycalendar->editCalendar('no', $user_id,$currentmonth,$year);    
    
    if($currentmonth == 12) { $month = 0; $year = $year +1; } else { $month = $currentmonth; }
    
    $nextmonth= $month + 1;
    
    $calendar2 = $this->Availabilitycalendar->editCalendar('no', $user_id,$nextmonth,$year); 
    
    $skills = $this->Users->UserSkills->find('all',['conditions'=>['UserSkills.user_id'=>$user_id],'order'=>'UserSkills.slug asc']);
    
    $employments = $this->Users->UserEmployments->find('all',['conditions'=>['UserEmployments.user_id'=>$user_id, 'UserEmployments.displayme'=>1],'order'=>['UserEmployments.rank' => 'ASC']]);
    $articles = $this->Users->UserArticles->find('all',['conditions'=>['UserArticles.user_id'=>$user_id, 'UserArticles.displayme'=>1],'order'=>['UserArticles.rank' => 'ASC']]);
    $publications = $this->Users->UserPublications->find('all',['conditions'=>['UserPublications.user_id'=>$user_id, 'UserPublications.displayme'=>1],'order'=>['UserPublications.rank' => 'ASC']]);
    $qualifications = $this->Users->UserQualifications->find('all',['conditions'=>['UserQualifications.user_id'=>$user_id, 'UserQualifications.displayme'=>1],'order'=>['UserQualifications.rank' =>'ASC']]);

    $this->set(compact('user', 'skills', 'employments', 'educations', 'articles', 'publications', 'qualifications', 'candidate', 'countries', 'calendar1', 'calendar2', 'calendar3'));
      
  }
  
}