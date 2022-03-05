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
class PaymentsController extends AppController
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
          $this->set('setstate', 'activity');
        
        $this->viewBuilder()->layout('frontside');

    }
    
    public function isAuthorized($user)
    {
        
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
        
        $payments = $this->Payments->find('all', [ 
            'conditions' => ['user_id' => $user_id]
        ]);
        
        $payments = $this->paginate($payments);

        $this->set(compact('payments'));
        $this->set('_serialize', ['payments']);
    }
      
     
      public function project()
    {
        
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
        
          $slug = $this->request->data['slug']; 
          $stage = $this->request->data['stage']; 
          
          $this->loadModel('Projects');
          $project = $this->Projects->find('all', [ 
            'conditions' => ['slug' => $slug, 'user_id' => $user_id]
          ]);
          $project = $project->first();
          

        if(empty($project->id)){
            $this->Flash->error(__('Sorry, this project does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        if($project->status <> 'Awarded') {
            $this->Flash->error(__('Sorry, this project has not been awarded to anyone.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'list']);
        }
        
        
        $awardeduser = $project->awardeduser;
        $slug = $project->slug;
        $custom = 'project_'.$user_id.'_'.$awardeduser.'_'.$project->id.'_'.$stage;
  
                                    
            $settings = [
            'cmd' => '_xclick',
            'business' => 'payment@skillbooker.com',
            'lc' => 'US',
            'item_name' => $project->name,
            'item_number' => $project->id,        
            'currency_code' => $project->currency_abbrev,
            'button_subtype' => 'services',
            'no_note' => '0',
            'tax_rate' => '0.000',
            'shipping' => '0.00',
            'bn' => 'PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest',
            'first_name' => $this->Auth->user('firstname'),
            'last_name' => $this->Auth->user('lastname'),
            'payer_email' => $this->Auth->user('email'),
            'return_url' => ROOTURL.'/payments/paypalreturn',
            'cancel_url' => ROOTURL.'/payments/paypalcancel',
            'notify_url' => ROOTURL.'/payments/notify',
            'custom' => $custom
        ];
        
        if($stage == 1){
            $settings['amount'] = $project->cost1;
        } 
        
        if($stage == 2){
            $settings['amount'] = $project->cost2;
        } 
        
        if($stage == 3){
            $settings['amount'] = $project->cost3;
        }
         
        if($stage == 4){
            $settings['amount'] = $project->cost4;
        }
        
        if(SANDBOX == 'false'){
          $settings['sandbox'] = false;
        } else {
          $settings['sandbox'] = true;
        }

          
          $this->loadComponent('Paypal');
          
          $this->log('settings' , 'debug');
          $this->log($settings , 'debug');
                         
          $paypal = $this->Paypal->activate($settings);
          
       }
       

    }
    
    
     
      public function extrawork()
    {
        
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
        
          $values = $this->request->data['slug'];
          $explode = explode('$',$values);
          $slug = $explode['0'];
          $id = $explode['1']; 

          
        $this->loadModel('Extrahours');
        $extrahours = $this->Extrahours->find('all', [ 
            'conditions' => ['id' => $id, 'user_id' => $user_id, 'slug' => $slug]
        ]);
        
        $extrahours = $extrahours->first();

        if(empty($extrahours->id)){
            $this->Flash->error(__('Sorry, there was an error.'));
            return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'progress',$slug]);
        }
        
        $awardeduser = $extrahours->freelancer;

        $itemname = 'Extra work '.$extrahours->hours.' hours';
        $custom = 'extrawork_'.$user_id.'_'.$awardeduser;
  

            $settings = [
            'cmd' => '_xclick',
            'business' => 'payment@skillbooker.com',
            'lc' => 'US',
            'item_name' => $itemname,
            'item_number' => $extrahours->id,        
            'currency_code' => $extrahours->currency_abbrev,
            'button_subtype' => 'services',
            'no_note' => '0',
            'tax_rate' => '0.000',
            'shipping' => '0.00',
            'bn' => 'PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest',
            'first_name' => $this->Auth->user('firstname'),
            'last_name' => $this->Auth->user('lastname'),
            'payer_email' => $this->Auth->user('email'),
            'return_url' => ROOTURL.'/payments/paypalreturn',
            'cancel_url' => ROOTURL.'/payments/paypalcancel',
            'notify_url' => ROOTURL.'/payments/notify',
            'custom' => $custom
        ];

        
        if(SANDBOX == 'false'){
          $settings['sandbox'] = false;
        } else {
          $settings['sandbox'] = true;
        }
          
          $this->loadComponent('Paypal');
          
          $this->log('settings' , 'debug');
          $this->log($settings , 'debug');
                         
          $paypal = $this->Paypal->activate($settings);
          
       }
       

    }
 
     
           public function credit($id = null)
    {  
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->loadModel('Salesoptions');
        $salesoptions = $this->Salesoptions->find('all',['conditions'=>['Salesoptions.id'=>$id]]);
        $salesoptions = $salesoptions->first();
        
        if(empty($salesoptions->id)){
            $this->Flash->error(__('Sorry, this option does not exist.'));
            return $this->redirect($this->referer());
        }
        
        $this->set('salesoptions', $salesoptions);
        
        
        $custom = $salesoptions->slug.'_'.$user_id;
                                    
        $settings = [
            'cmd' => '_xclick',
            'business' => 'payment@skillbooker.com',
            'lc' => 'US',
            'item_name' => $salesoptions->name,
            'item_number' => $salesoptions->id,
            'amount' => $salesoptions->price,
            'currency_code' => 'USD',
            'button_subtype' => 'services',
            'no_note' => '0',
            'tax_rate' => '0.000',
            'shipping' => '0.00',
            'bn' => 'PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest',
            'first_name' => $this->Auth->user('firstname'),
            'last_name' => $this->Auth->user('lastname'),
            'payer_email' => $this->Auth->user('email'),
            'return_url' => ROOTURL.'/payments/paypalreturn',
            'cancel_url' => ROOTURL.'/payments/paypalcancel',
            'notify_url' => ROOTURL.'/payments/notify',
            'custom' => $custom
        ];
        
        if(SANDBOX == 'false'){
          $settings['sandbox'] = false;
        } else {
          $settings['sandbox'] = true;
        }
          
          $this->loadComponent('Paypal');
          
$this->log('credit- > settings' , 'debug');
$this->log($settings , 'debug');
                         
          $paypal = $this->Paypal->activate($settings);
          
    }
    
    
        public function notify()
    {
      
        if(SANDBOX == 'false'){
          $settings['sandbox'] = false;
        } else {
          $settings['sandbox'] = true;
        }
            
          $this->loadComponent('Paypal');
          $data = $this->Paypal->response($settings);
          
$this->log($data , 'debug');
           
          if (is_array($data)) {
          
$this->log('notifvy -> after array check' , 'debug');
$this->log($data , 'debug');
              
              $source = '';
              $user_id = '';
              $awardeduser = '';
              $project_id = '';
              $stage = '';
              
              $custom = $data['custom'];
              $explode = explode('_', $custom);
              
              $source = $explode[0];
              $user_id = $explode[1];
              if(!empty($explode[2])) { $awardeduser = $explode[2]; }
              if(!empty($explode[3])) { $project_id = $explode[3]; }
              if(!empty($explode[4])) { $stage = $explode[4]; }
              
              $Table = TableRegistry::get('payments');
              $payment = $Table->newEntity();
              
              $payment->direction = 'Paid';
              $payment->txnid = $data['txn_id'];
              $payment->item_name = $data['item_name'];
              $payment->item_number = $data['item_number'];
              $payment->payment_amount = $data['payment_amount'];
              $payment->payment_status = $data['payment_status'];
              $payment->payment_currency = $data['payment_currency'];
              $payment->receiver_email = $data['receiver_email'];
              $payment->payer_email = $data['payer_email'];
              $payment->custom = $data['custom'];
              $payment->user_id = $user_id;
              $payment->payuser = $user_id;
              $payment->awardeduser = $awardeduser;
              $payment->source = $source;
              $payment->project_id = $project_id;
              $payment->stage = $stage;
              $payment->createdtime = date("Y-m-d H:i:s");
              
$this->log('notify -> payment array' , 'debug');                 
$this->log($payment , 'debug');

$this->log('source' , 'debug'); 
$this->log($source , 'debug');
              
              if ($Table->save($payment)) {
              
              $receive = $Table->newEntity();
              
              $receive->direction = 'Received';
              $receive->txnid = $data['txn_id'];
              $receive->item_name = $data['item_name'];
              $receive->item_number = $data['item_number'];
              $receive->payment_amount = $data['payment_amount'];
              $receive->payment_status = $data['payment_status'];
              $receive->payment_currency = $data['payment_currency'];
              $receive->receiver_email = $data['receiver_email'];
              $receive->payer_email = $data['payer_email'];
              $receive->custom = $data['custom'];
              $receive->user_id = $awardeduser;
              $receive->awardeduser = $awardeduser;
              $receive->payuser = $user_id;
              $receive->source = $source;
              $receive->project_id = $project_id;
              $receive->stage = $stage;
              $receive->createdtime = date("Y-m-d H:i:s");
              
              $Table->save($receive);
              
              $amount = $data['payment_amount'];
                    
               if($source == 'jobs') {
                  $this->logjobs($user_id, $data);
               }
               
              if($source == 'subscription') {
                  $this->logsubscription($user_id, $data);
               }
                
               if($source == 'project') {
                  $this->logproject($user_id, $project_id, $stage, $amount);
               }
               
                if($source == 'extrawork') {
                  $this->logextrawork($user_id, $data['item_number'], $amount);
               }
               
              if($source == 'software') {
                  $this->logsoftware($user_id, $data['item_number'], $amount);
               }
    
                        
              }  else { 
$this->log('salesoption empty' , 'debug');
              }          
                
          }

    }  
    
 
     
     public function logjobs($user_id, $data) {
     
      $this->loadModel('Salesoptions');
      $salesoptions = $this->Salesoptions->find('all',['conditions'=>['Salesoptions.slug'=>'jobs', 'Salesoptions.id'=>$data['item_number']]]);
      $salesoptions = $salesoptions->first();
      
$this->log('logjobs-> sales options' , 'debug');
$this->log($salesoptions , 'debug');
      
      if(!empty($salesoptions->id)) {
      
        $this->loadModel('UserCredit');
        $checkcredit = $this->UserCredit->find('all',['conditions'=>['UserCredit.user_id'=>$user_id]]);
        $checkcredit = $checkcredit->first();                  
        
      $Tableuc = TableRegistry::get('user_credit'); 
      if(!empty($checkcredit->id)) {
                            
          $usercredit = $Tableuc->get($checkcredit->id);
          $usercredit->jobs = $checkcredit->jobs + $salesoptions->realvalue;
          $usercredit->subscription = $salesoptions->level;
          $usercredit->subscriptiondate = date('Y-m-d');
          $usercredit->modified = date('Y-m-d');

       } else {

          $usercredit = $Tableuc->newEntity();
          $usercredit->user_id = $user_id;
          $usercredit->jobs = $salesoptions->realvalue;
          $usercredit->subscription = $salesoptions->level;
          $usercredit->subscriptiondate = date('Y-m-d');
          $usercredit->created = date('Y-m-d');
          $usercredit->modified = date('Y-m-d');
       
       }
        $Tableuc->save($usercredit);
        
$this->log('logjobs->saved user credit' , 'debug');
$this->log($usercredit , 'debug');
            
          $this->loadModel('Users');
          $user = $this->Users->get($user_id);
                  
$this->log('logjob->paid' , 'debug');
$this->log($user , 'debug');
                      
          $keys = array();
          $keys[] = $user->firstname;
          $keys[] = $salesoptions->description;
          
          $sendvalues = array();
          $sendvalues['to'] = $data['receiver_email'];
          $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
          $sendvalues['keys'] = $keys;
          $sendvalues['templateid'] = 6;
      
      if(SENDMAIL == 1) {        
          $this->loadComponent('Emailc');                  
          $emailc = $this->Emailc->send_email($sendvalues); 
      }
        
        }            
     
     }
     
     
    public function logsubscription($user_id, $data) {
     
      $this->loadModel('Salesoptions');
      $salesoptions = $this->Salesoptions->find('all',['conditions'=>['Salesoptions.slug'=>'subscription', 'Salesoptions.id'=>$data['item_number']]]);
      $salesoptions = $salesoptions->first();
      
$this->log('logsubscription->subscription options' , 'debug');
$this->log($salesoptions , 'debug');
      
      if(!empty($salesoptions->id)) {
      
        $this->loadModel('UserCredit');
        $checkcredit = $this->UserCredit->find('all',['conditions'=>['UserCredit.user_id'=>$user_id]]);
        $checkcredit = $checkcredit->first();                  
        
      $Tableuc = TableRegistry::get('user_credit'); 
      if(!empty($checkcredit->id)) {
                            
          $usercredit = $Tableuc->get($checkcredit->id);
          $usercredit->subscriptionlevel = $salesoptions->level;
          $usercredit->subscriptiondate = date('Y-m-d');
          $usercredit->modified = date('Y-m-d');

       } else {

          $usercredit = $Tableuc->newEntity();
          $usercredit->user_id = $user_id;
          $usercredit->subscriptionlevel = $salesoptions->level;
          $usercredit->subscriptiondate = date('Y-m-d');
          $usercredit->created = date('Y-m-d');
          $usercredit->modified = date('Y-m-d');
       
       }
        $Tableuc->save($usercredit);
        
        
$this->log('logsubscription->saved user credit' , 'debug');
$this->log($usercredit , 'debug');
            
          $this->loadModel('Users');
          $user = $this->Users->get($user_id);
                  
$this->log('logsubscription->paid' , 'debug');
$this->log($user , 'debug');
                      
          $keys = array();
          $keys[] = $user->firstname;
          $keys[] = $salesoptions->description;
          
          $sendvalues = array();
          $sendvalues['to'] = $data['receiver_email'];
          $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
          $sendvalues['keys'] = $keys;
          $sendvalues['templateid'] = 6;


      if(SENDMAIL == 1) {              
          $this->loadComponent('Emailc');                  
          $emailc = $this->Emailc->send_email($sendvalues); 
      }
        
        }            
     
     }



     public function logproject($user_id, $project_id, $stage, $amount) {
     
         $this->log('1 logpayments->update payment' , 'debug');
        
        $this->loadModel('Projects'); 
        $project = $this->Projects->find('all', [ 
          'conditions' => ['id' => $project_id, 'user_id' => $user_id]
        ]);
        $project = $project->first();
        
    $this->log('logpayments->update payment' , 'debug');
    $this->log($project , 'debug');

    if(!empty($project->id)){
    
    $stageinterval = $project->stageinterval;

    $Table = TableRegistry::get('Projects');
    $update = $Table->get($project->id);
            
        if($stage == 1){
            $update->paid1 = $amount;
        } 
        
        if($stage == 2){
            $update->paid2 = $amount;
        } 
        
        if($stage == 3){
            $update->paid3 = $amount;
        }
         
        if($stage == 4){
            $update->paid4 = $amount;
        }
        
        if($stage == $stageinterval) {
          $update->status = 'Completed';
        }

        if($Table->save($update)) { 
        
          $this->log('update payment' , 'debug');
          $this->log($update , 'debug');
        }
     
    }

  }
     
     
    public function logextrawork($user_id, $id, $amount) {
     
         $this->log('1 logpayments->update payment' , 'debug');
        
        $this->loadModel('Extrahours');
        $extrahours = $this->Extrahours->find('all', [ 
            'conditions' => ['id' => $id, 'user_id' => $user_id]
        ]);
        
        $extrahours = $extrahours->first();
        
    $this->log('logpayments->update payment' , 'debug');
    $this->log($project , 'debug');

        if(!empty($extrahours->id)){

            $Table = TableRegistry::get('Extrahours');
            $update = $Table->get($extrahours->id);
            
            $update->paid = $amount;

        if($Table->save($update)) {         
          $this->log('update payment' , 'debug');
          $this->log($update , 'debug');
        }
     
       }

     }
       
    
    
    public function paypalreturn()
    {            
          $this->Flash->success(__('Thank you for your payment.'));
          
      if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to access this page.'));
          return $this->redirect(['controller' => 'users', 'action' => 'login']);
      }
      
            $user_id = $this->Auth->user('id');
            
            $this->loadModel('Users');
            $users = $this->Users->find('all', ['conditions' => ['id' => $user_id]]);		
            $users = $users->first();

            
            $this->loadModel('UserCredit');
            $credit = $this->UserCredit->find('all', [
            'conditions' => ['user_id = '.$user_id],
            ]);
            $credit = $credit->first();
            
            $jobcredit = 0;
            $softwarecredit = 0;
            $subscription = 'Entry';
            $subscriptiondate = '0';
            
            if(!empty($credit)) {
            
             $jobcredit = $credit->jobs;
             $softwarecredit = $credit->software;
             $subscription = $credit->subscriptionlevel;
             $subscriptiondate = $credit->subscriptiondate;
             
            } 
            
            $users['jobcredit'] = $jobcredit;
            $users['subscription'] = $subscription;
            $users['subscriptiondate'] = $subscriptiondate;
            $users['softwarecredit'] = $softwarecredit;
            
            
            $this->Auth->setUser($users);


         // return $this->redirect($this->referer());

        //$this->log('hit return' , 'debug');
        /*
        if  (in_array  ('curl', get_loaded_extensions())) {
          $curl = "cURL is installed  on this server";
        } else {
          $curl = "cURL is NOT installed on this server";
        }
          $this->set('curl', $curl);
          */
     // var_dump($_GET);
      $custom = $_GET['cm'];
      $explode = explode('_', $custom);
      $source = $explode[0];
      
        if($source == 'jobs'){
          return $this->redirect(['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'add']);
        }
        
        if($source == 'subscription') {
          return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'index']);
        }
        
        if($source == 'project') {
          return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
        }
        
        if($source == 'extrawork') {
          return $this->redirect(['plugin' => null, 'controller' => 'projects', 'action' => 'lists']);
        }
        
        if($source == 'software') {
          return $this->redirect(['plugin' => null, 'controller' => 'softwares', 'action' => 'lists']);
        }
        
    }
    
       
    public function paypalcancel()
    {
    
    }
    
         public function logsoftware($user_id, $data) {
     
      $this->loadModel('Salesoptions');
      $salesoptions = $this->Salesoptions->find('all',['conditions'=>['Salesoptions.slug'=>'software', 'Salesoptions.id'=>$data['item_number']]]);
      $salesoptions = $salesoptions->first();
      
$this->log('logjobs-> sales options' , 'debug');
$this->log($salesoptions , 'debug');
      
      if(!empty($salesoptions->id)) {
      
        $this->loadModel('UserCredit');
        $checkcredit = $this->UserCredit->find('all',['conditions'=>['UserCredit.user_id'=>$user_id]]);
        $checkcredit = $checkcredit->first();                  
        
      $Tableuc = TableRegistry::get('user_credit'); 
      if(!empty($checkcredit->id)) {
                            
          $usercredit = $Tableuc->get($checkcredit->id);
          $usercredit->software = $checkcredit->software + $salesoptions->realvalue;
          $usercredit->subscription = $salesoptions->level;
          $usercredit->subscriptiondate = date('Y-m-d');
          $usercredit->modified = date('Y-m-d');

       } else {

          $usercredit = $Tableuc->newEntity();
          $usercredit->user_id = $user_id;
          $usercredit->software = $salesoptions->realvalue;
          $usercredit->subscription = $salesoptions->level;
          $usercredit->subscriptiondate = date('Y-m-d');
          $usercredit->created = date('Y-m-d');
          $usercredit->modified = date('Y-m-d');
       
       }
        $Tableuc->save($usercredit);
        
$this->log('logjobs->saved user credit' , 'debug');
$this->log($usercredit , 'debug');
            
          $this->loadModel('Users');
          $user = $this->Users->get($user_id);
                  
$this->log('logjob->paid' , 'debug');
$this->log($user , 'debug');
                      
          $keys = array();
          $keys[] = $user->firstname;
          $keys[] = $salesoptions->description;
          
          $sendvalues = array();
          $sendvalues['to'] = $data['receiver_email'];
          $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
          $sendvalues['keys'] = $keys;
          $sendvalues['templateid'] = 6;
      
      if(SENDMAIL == 1) {        
          $this->loadComponent('Emailc');                  
          $emailc = $this->Emailc->send_email($sendvalues); 
      }
        
        }            
     
     }
     
}
