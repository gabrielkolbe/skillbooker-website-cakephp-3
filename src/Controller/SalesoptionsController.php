<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Salesoptions Controller
 *
 * @property \Manager\Model\Table\SalesoptionsTable $Salesoptions
 */
class SalesoptionsController extends AppController
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
        
         return parent::isAuthorized($user);
    }
      
    
      public function jobs()
    {
        $this->loadModel('Salesoptions');
        $salesoptions = $this->Salesoptions->find('all',['conditions'=>['Salesoptions.slug'=>'jobs']]);
        $this->set('salesoptions', $salesoptions);
        
    }
    
          public function freelancers()
    {
        $this->loadModel('Salesoptions');
        $salesoptions = $this->Salesoptions->find('all',['conditions'=>['Salesoptions.slug'=>'subscription']]);
        $this->set('salesoptions', $salesoptions);
        
    }
    
          public function software()
    {
        $this->loadModel('Salesoptions');
        $salesoptions = $this->Salesoptions->find('all',['conditions'=>['Salesoptions.slug'=>'software']]);
        $this->set('salesoptions', $salesoptions);
        
    }
    
          public function subscriptionmodal()
    {
          
     $this->viewBuilder()->layout('ajax'); 
      
    }
    

}
