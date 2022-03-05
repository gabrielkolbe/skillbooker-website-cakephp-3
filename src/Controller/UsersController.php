<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Network\Session; 

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

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
    
     public function index()
    {
        return $this->redirect('login');
    }        
    
        public function login()
    {   
        if(is_null($this->Auth->user('id'))){

        if ($this->request->is('post')) {
        
      if(GOOGLECAPTCHA == 1) {          
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLESECRETKEY.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        
          if(!$responseData->success == true) { 
            $this->Flash->error(__('Hi Cyborg you used the reCaptcha wrong!'));
          return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
          }  
        
        } else {
          $this->Flash->error(__('Please use reCaptcha to tell us your are not a rogue cyborg'));
          return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        }           
      }  
        
            $user = $this->Auth->identify();
            if ($user) {
            
            $this->loadModel('UserCredit');
            $credit = $this->UserCredit->find('all', [
            'conditions' => ['user_id = '.$user['id']],
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
            
            $user['jobcredit'] = $jobcredit;
            $user['subscription'] = $subscription;
            $user['subscriptiondate'] = $subscriptiondate;
            $user['softwarecredit'] = $softwarecredit;
            
            
                $this->Auth->setUser($user);
                
                $user_id = $user['id'];
                $user_role_id = $user['role_id'];
                
      
                if($user_role_id == 1) { 
                  return $this->redirect(['plugin' => 'manager', 'controller' => 'sitesettings', 'action' => 'index']);
                } else {
                 // return $this->redirect(REDIRECTURL);
                 return $this->redirect($this->referer());                   
                }
               // return $this->redirect($this->Auth->redirectUrl());              
            }
            $this->Flash->error(__('Invalid username or password or your account has not been approved yet. Please contact support'));
        }
        } else {
             return $this->redirect('/');
        } 
    }
    
    public function loginmodal()
    {   
      $this->viewBuilder()->layout('ajax');
    }
    

  
  
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    
    
  public function registermodal()
    {
      $this->viewBuilder()->layout('ajax');
    }
 

   public function register()
    {
        
        if(is_null($this->Auth->user('id'))) {
        } else {
            return $this->redirect('/');
        }
        
        $user = $this->Users->newEntity();
        
        if ($this->request->is('post')) {
               
      if(GOOGLECAPTCHA == 1) {          
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLESECRETKEY.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        
          if(!$responseData->success == true) { 
            $this->Flash->error(__('Hi Cyborg you used the reCaptcha wrong!'));
            return $this->redirect($this->referer());
          }  
        
        } else {
          $this->Flash->error(__('Please use reCaptcha to tell us your are not a rogue cyborg'));
          return $this->redirect($this->referer());
        }           
      }        
         
        $user = $this->Users->patchEntity($user, $this->request->data);
        
      $exists = $this->Users->exists(['email' => $user->email]);
      
      if($exists == true){
          $this->Flash->error(__('Sorry, your account already exist, please login'));
          return $this->redirect(['action' => 'login']);
      }
            
            $user->role_id = 2;
                        
            $firstname = ucfirst($user->firstname); 
            $user->firstname = $firstname;
            
            $lastname = ucfirst($user->lastname); 
            $user->lastname = $lastname;
            
            $name = $firstname.' '.$lastname;
            $user->name = $name;
            
            $email = strtolower($user->email);
            $user->email = $email;
            
            $user->country_id = DEFAULT_COUNTRYID;
 
            $verify_validate_string = Security::hash($email . time(), 'sha1', true);
            $user->validate_string = $verify_validate_string; 
            
            $this->loadComponent('slugcreator');
            $user->slug = $this->slugcreator->userslug($name);
            
            $user->status = 0;
            $user->verified = 0;
            $user->password = 0;
          
            $username = $user->name;
            $email = $user->email;
                     
            //return debug($user);                       

            if ($this->Users->save($user)) {
            
            $keys = array();
            $keys[] = $username;
            $keys[] = $verify_validate_string;
            
            $sendvalues = array();
            $sendvalues['to'] = $email;
            $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 1;
            
           // return debug($sendvalues);
           // die;
            
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues);  
            
              $this->Flash->success(__('Thank you for your registration, please verify your email address by click on the link send to you.'));
              return $this->redirect('/');
              
            } else {
                $this->Flash->error(__('Sorry, your account could not be created please contact support'));
               // return $this->redirect(['action' => 'contact']);
            }
        }       
        
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
 


public function getpassword(){

		if ($this->request->is('post')) {
    
      if(GOOGLECAPTCHA == 1) {          
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLESECRETKEY.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        
          if(!$responseData->success == true) { 
            $this->Flash->error(__('Hi Cyborg you used the reCaptcha wrong!'));
            return $this->redirect($this->referer());
          }  
        
        } else {
          $this->Flash->error(__('Please use reCaptcha to tell us your are not a rogue cyborg'));
          return $this->redirect($this->referer());
        }           
      }  
        
        

            if (empty($this->request->data['email'])) {  
              $this->Flash->error(__('We get a blank request. Please try again.'));
              return $this->redirect(['action' => 'getpassword']);
            }

        				$users = $this->Users->find('all', ['conditions' => ['email' => $this->request->data['email']], 'fields' => ['name', 'email']]);		
                $user = $users->first();
             
                  if ($users->isEmpty()) {
                    $this->Flash->error(__('No one registered with that email address.'));
                    return $this->redirect(['action' => 'getpassword']);
                  }
                  
                      $this->loadComponent('Encrypt'); 
                      $encrypt =  $this->Encrypt->encode($user->email);
                      
                      $keys = array(); 
                      $keys[] = $user->name;
                      $keys[] = "<a href='" . DOMAIN . "/users/resetpassword/" . $encrypt . "'>Click Here To Change Password</a>";
            
                              					
                      $sendvalues = array();
                      $sendvalues['to'] = $user->email;
                      $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
                      $sendvalues['keys'] = $keys;
                      $sendvalues['subject'] = 'Reset your password';    //not needed
                     // $sendvalues['h1value'] = '<h1>Account Activation</h1>';     //not needed
                      $sendvalues['templateid'] = 3;
                      
                     // return debug($sendvalues);
 
        
  
                      
                      $this->loadComponent('Emailc');                  
                      $emailc = $this->Emailc->send_email($sendvalues); 
                                
                  $this->Flash->error(__('Please check your email, the password reset request has been sent'));
                  return $this->redirect(['action' => 'login']);

	}
} 


  
public function resetpassword($encrypt) {
      	if ($this->request->is('post')) {

            if (empty($this->request->data)) {  
              $this->Flash->error(__('We get a blank request. Please try again.'));
              return $this->redirect(['controller' => 'users', 'action' => 'resetpassword', $encrypt]);
            }
            
            if($this->request->data['firstpassword'] <> $this->request->data['confirmpassword']) {
              $this->Flash->error(__("Sorry, your passwords don't match"));
              return $this->redirect(['controller' => 'users', 'action' =>'resetpassword', $encrypt]);
            }
            
                $this->loadComponent('Encrypt'); 
                $decrypt =  $this->Encrypt->decode($encrypt);
    
    
	              $users = $this->Users->find('all', ['conditions' => ['email' => $decrypt], 'fields' => ['id']]);		
                $user = $users->first();
  
                                                                                
                  if (empty($user)) {
                        $this->Flash->error(__('Sorry, your account has not been found'));
                        return $this->redirect(['controller' => 'users', 'action' => 'register']);
                  }
                $obj = new DefaultPasswordHasher;
                $password = $obj->hash($this->request->data['firstpassword']);  
             
                $us = $this->Users->patchEntity($user, $this->request->data);
                $us->password = $password;          
                  
              if ($this->Users->save($us)) {
                  $this->Flash->success(__('Your password has been updated successfully'));
                  return $this->redirect(['controller' => 'users', 'action' => 'login']);
              } else {
                  $this->Flash->error(__('oops, somethings when badly wrong!'));
              }             
}   
}

    public function changeslugmodal() {
      $this->viewBuilder()->layout('ajax'); 
      if(is_null($this->Auth->user('id'))){
            $this->Flash->success(__('Please login to access this page.'));
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
      }
    }
    
    
  public function changeslugaction() {
        $this->autoRender = false;
      	if ($this->request->is('post')) {

            if(is_null($this->Auth->user('id'))){
                $this->Flash->success(__('Please login to access this page.'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else {
            
            $user_id = $this->Auth->user('id');
            
            }
            
            if (empty($this->request->data['slug'])) {  
              $this->Flash->error(__('We get a blank request. Please try again to change your slug'));
              return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            }
            
            if($this->request->data['slug'] <> $this->request->data['confirmslug']) {
              $this->Flash->error(__("Sorry, your slugs don't match"));
              return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            } else {
             $slug = $this->request->data['slug']; 
            }

            
            if (!preg_match('/^[A-Za-z0-9\-\_]+$/', $slug))
            {
              $this->Flash->error(__("Sorry, only characters A-Z, a-z, 0-9, -, _"));
              return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            }
                    
            $users = $this->Users->find('all', ['conditions' => ['slug' => $slug], 'fields' => ['id']]);		
            $check = $users->count();
                                                                            
          if ($check > 0) {
          
            $this->Flash->error(__('Sorry, this slug has been taken, it has to be unique'));
            return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
          
          }
             
              $Table = TableRegistry::get('Users');
              $user = $Table->get($user_id);

              $user->slug = $slug;

              if ($Table->save($user)) {
              
                $users = $this->Users->find('all', ['conditions' => ['id' => $user_id]]);		
                $users = $users->first();
                $this->Auth->setUser($users);
                                
                $this->Flash->success(__('Your slug has been updated successfully'));
                return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
                  
                  
              } else {
                  $this->Flash->error(__('oops, somethings when badly wrong!'));
              }                             
       
  }
  }
    

    public function changepassword() {
      $this->viewBuilder()->layout('ajax'); 
      if(is_null($this->Auth->user('id'))){
            $this->Flash->success(__('Please login to access this page.'));
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
      }
    }

    public function changepasswordaction() {
        $this->autoRender = false;
      	if ($this->request->is('post')) {

            if(is_null($this->Auth->user('id'))){
                $this->Flash->success(__('Please login to access this page.'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }
            
            if (empty($this->request->data['firstpassword'])) {  
              $this->Flash->error(__('We get a blank request. Please try again to change your password'));
              return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            }
            
            if($this->request->data['firstpassword'] <> $this->request->data['confirmpassword']) {
              $this->Flash->error(__("Sorry, your passwords don't match"));
              return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            }
    
                $user_id = $this->Auth->user('id');
        
	              $users = $this->Users->find('all', ['conditions' => ['id' => $user_id], 'fields' => ['id']]);		
                $user = $users->first();
  
                                                                                
                  if (empty($user)) {
                        $this->Flash->error(__('Sorry, your account has not been found'));
                        return $this->redirect(['controller' => 'users', 'action' => 'register']);
                  }
                $obj = new DefaultPasswordHasher;
                $password = $obj->hash($this->request->data['firstpassword']);  
             
                $us = $this->Users->patchEntity($user, $this->request->data);
                $us->password = $password;          
                  
              if ($this->Users->save($us)) {
                  $this->Flash->success(__('Your password has been updated successfully'));
                  return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
              } else {
                  $this->Flash->error(__('oops, somethings when badly wrong!'));
              }             
}   
}


public function contact() {

      if ($this->request->is('post')) {
 
      if(GOOGLECAPTCHA == 1) {          
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLESECRETKEY.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        
          if(!$responseData->success == true) { 
            $this->Flash->error(__('Hi Cyborg you used the reCaptcha wrong!'));
            return $this->redirect($this->referer());
          }  
        
        } else {
          $this->Flash->error(__('Please use reCaptcha to tell us your are not a rogue cyborg'));
          return $this->redirect($this->referer());
        }           
      } 
      
            $contactHistoryTable = TableRegistry::get('Inbox');
            $contact = $contactHistoryTable->newEntity();
            
            
            $contact->name = $this->request->data['name'];
            $contact->email = $this->request->data['email'];
            $contact->tel = $this->request->data['tel'];
            $contact->message = $this->request->data['message'];
            $contact->created = date("Y-m-d H:i:s"); 
            $contact->modified = date("Y-m-d");
                 
            if ($contactHistoryTable->save($contact)) {
        
            
            $keys = array();
            $keys[] = $contact->name;
            $keys[] = $contact->email;
            $keys[] = $contact->tel;
            $keys[] = $contact->message;
    
					
            $sendvalues = array();
            $sendvalues['to'] = 'contact@skillbooker.com';
            $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
            $sendvalues['keys'] = $keys;
            $sendvalues['subject'] = 'Message from '.$contact->name.' on '.SITE;    //not needed
            $sendvalues['templateid'] = 4;

            $this->loadComponent('Emailc');
                           
            $emailc = $this->Emailc->send_email($sendvalues);   
          
            $this->Flash->success(__('Your email has been sent, we will be in contact soon'));
            return $this->redirect('/');
    
            } else {
                $this->Flash->error(__('Sorry, your email could not be sent, please phone us'));
            }
        }
        
        $this->loadModel('Inbox');
        $contactHistory = $this->Inbox->newEntity();
        $this->set(compact('contactHistory'));
        $this->set('_serialize', ['contactHistory']);
}


public function resentverification() {
		 if ($this->request->is('post')) {
     
        if(GOOGLECAPTCHA == 1) {          
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLESECRETKEY.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        
          if(!$responseData->success == true) { 
            $this->Flash->error(__('Hi Cyborg you used the reCaptcha wrong!'));
            return $this->redirect($this->referer());
          }  
        
        } else {
          $this->Flash->error(__('Please use reCaptcha to tell us your are not a rogue cyborg'));
          return $this->redirect($this->referer());
        }           
      }  
      
      
          if (empty($this->request->data['email'])) {  
              $this->Flash->error(__('We get a blank request. Please try again.'));
              return $this->redirect(['plugin'=>null, 'controller'=>'users', 'action' => 'resentverification']);
          }

					$users = $this->Users->find('all', ['conditions' => ['email' => $this->request->data['email']], 'fields' => ['name', 'email', 'validate_string']]);		
          $user = $users->first();
                                                                                  
          if (empty($user)) {
                $this->Flash->error(__('Sorry, your account has not been found'));
                return $this->redirect(['plugin'=>null, 'controller'=>'users', 'action' => 'register']);
          }
          
          $validate_string = $user->validate_string;
          
          if(empty($validate_string)) {
           $this->Flash->error(__('No verification available, this acount might have already been verified, please contact support'));
           return $this->redirect(['plugin'=>null, 'controller'=>'users', 'action' => 'login']);
          }
          
        $keys = array();
        $keys[] = $user->name;
        $keys[] = $validate_string;
        
        $sendvalues = array();
        $sendvalues['to'] = $user->email;
        $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
        $sendvalues['keys'] = $keys;
        $sendvalues['subject'] = 'RESENT: Activate your account, verify your email address';    //not needed
        $sendvalues['templateid'] = 1;
        
        $this->loadComponent('Emailc');                  
        $emailc = $this->Emailc->send_email($sendvalues);  
  
        $this->Flash->success(__('Your account verification has been resend to your email address'));
        return $this->redirect(['plugin'=>null, 'controller'=>'users', 'action' => 'login']);
              
    }     
}
public function deleteconfirm()
    {
    $this->viewBuilder()->layout('ajax');
    }
public function deleteconfirmaction()
    {
        if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to access this page.'));
          return $this->redirect(['action' => 'login']);
        }
            
        $user_id = $this->Auth->user('id');
        $user = $this->Users->get($user_id);
        
        $this->set('user', $user);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
    
        if ($this->Users->delete($user)) {
          
          $this->Flash->success(__('Your account has been deleted, thank you.'));
          return $this->redirect($this->Auth->logout());
          
        } else {
            $this->Flash->error(__('Your account could not be deleted. Please, contact support.'));
        }

        return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        } 
    }  
    
public function getstate($id = null)
    {
        $this->loadModel('States');   
        $list = $this->States->find('list', ['fields'=>['States.id', 'States.name'], 'conditions' => ['States.country_id' => $id],'order'=> ['States.name'=>'ASC']]);
        $this->set('list', $list);   
    }
    
public function editdetails()
    {
        $this->viewBuilder()->layout('ajax');
        $user_id = $this->Auth->user('id');
        $user = $this->Users->get($user_id);
        
        $countries = $this->Users->Countries->find('list');
        $industries = $this->Users->Industries->find('list');
        $communicationsettings = $this->Users->Communicationsettings->find('list');
        //$user->jobtitle = ucfirst($user->jobtitle);        
                
        $this->set(compact('user', 'countries', 'industries', 'communicationsettings'));
        $this->set('_serialize', ['user']);
}


    
public function editaction()
{   
        if(is_null($this->Auth->user('id'))){
            $this->Flash->success(__('Please login to access this page.'));
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        
        $this->viewBuilder()->layout('ajax');
        $user_id = $this->Auth->user('id');
        $user = $this->Users->get($user_id);
        $this->set('user', $user);
        $oldimage = $user->avatar;

//$user = $this->Users->patchEntity($user, $this->request->data, ['validator' => 'Account']); 
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $firstname = ucfirst($user->firstname); 
            $user->firstname = $firstname;
            
            $lastname = ucfirst($user->lastname); 
            $user->lastname = $lastname;
            
            $name = $firstname.' '.$lastname;
            $user->name = $name;
            
            $user->email = strtolower($user->email);
            
            if(!empty($this->request->data['industry_id'])) {
            
            $this->loadModel('Industries');
              $industry = $this->Industries
                ->find()
                ->where(['id' => $this->request->data['industry_id']])
                ->first();
         
            $user->display_industry = $industry->name; 
            
            }    

            if(!empty($this->request->data['country_id'])) {
            
              $this->loadModel('Countries');
              $country = $this->Countries
                ->find()
                ->where(['id' => $this->request->data['country_id']])
                ->first();
         
            $user->display_country = $country->name;
            
            }
            
            if(!empty($this->request->data['communicationsetting_id'])) {
              $this->loadModel('Communicationsettings');
              $communicationsettings = $this->Communicationsettings
                ->find()
                ->where(['id' => $this->request->data['communicationsetting_id']])
                ->first();
         
            $user->display_communicationsetting = $communicationsettings->name;
            
            }
            
            if (!empty($this->request->data['avatar']['name'])) {
            
              $this->loadComponent('Image');
              $location = WWW_ROOT . '/img/uploads/avatars/';
              $image = $this->Image->uploadimage($location, $this->request->data['avatar']);        
    
                if(!empty($image)){
        
                      $this->Image->load($location.$image);
                      $this->Image->resizeToWidth(140);
                      $this->Image->save($location.$image);
                      $user->avatar = $image;
                      
                } else {
                    $this->Flash->error(__('Avatar has te be jpg, jpeg, gif or png'));
                    return $this->redirect(['action' => 'index']);
                }
                
              if(!empty($oldimage)){
                unlink($location.$oldimage);
              }
    
            } else {
             $user->avatar = $oldimage;
            }            

          
            if ($this->Users->save($user)) {
            
                $this->Auth->setUser($user);
  
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'portfolio', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }   
}



  public function verify($string) {

  $countries = $this->Users->Countries->find('list');
  $industries = $this->Users->Industries->find('list');

  $this->set(compact('countries', 'industries', 'string'));
        
  $this->set('_serialize', ['user']); 
  
  if ($this->request->is('post')) {
  
  if(empty($string)){ 
    $this->Flash->error(__('You need a validation code'));
  	return $this->redirect(['action' => 'register']);
  }
  
  $exists = $this->Users->exists(['validate_string' => $string]);
  
  if($exists == false){
    $this->Flash->error(__('Sorry, you are using a wrong or old link'));
    return $this->redirect(['action' => 'login']);
  }
  
  $query = $this->Users->find('all', [
    'conditions' => ['Users.validate_string' => $string]
  ]);
  
  $user = $query->first();
   
  $verify = $user->verify;
  if($verify == 1){
        $this->Flash->error(__('Your account is already verified. Please login to access to your account'));
			  return $this->redirect(['action' => 'login']);
  }
   
    $user = $this->Users->patchEntity($user, $this->request->data, ['validate' => 'verify']);
    
    $user->modified = date('Y-m-d');
    
   // debug($user);
   // die;
   
    if(empty($user->firstpassword)){
      $this->Flash->error(__('Please insert a password'));
      return $this->redirect(['action' => 'verify', $string]);
    }
    
    if($user->firstpassword <> $user->confirmpassword) {
      $this->Flash->error(__("Sorry, your passwords don't match"));
      return $this->redirect(['action' => 'verify', $string]);
    }
    
    
    $obj = new DefaultPasswordHasher;
    $password = $obj->hash($user->firstpassword);  
    $user->password = $password;
    $user->validate_string = '';
    $user->verified = 1;
    $user->status = 1;
    //'5ee57b3d5cf253eb755afacf76d6e2a412ab5fb4'
            
    if (!empty($this->request->data['avatar']['name'])) {
    
      $this->loadComponent('Image');
      $location = WWW_ROOT . '/img/uploads/avatars/';
      $image = $this->Image->uploadimage($location, $this->request->data['avatar']);        

        if(!empty($image)){
        
              $this->Image->load($location.$image);
              $this->Image->resizeToWidth(140);
              $this->Image->save($location.$image);
              $user->avatar = $image;
              
        } else {
            $this->Flash->error(__('Avatar has te be jpg, jpeg, gif or png'));
            return $this->redirect(['action' => 'verify', $string]);
        }
    }
      
    //  debug($user);
    //  die;      

          if ($this->Users->save($user)) { 
          
              $Table = TableRegistry::get('Candidates');
              $can = $Table->newEntity();
              
              $can->user_id = $user->id;
              $can->created = date('Y-m-d');
              $can->modified = date('Y-m-d');
              
              if ($Table->save($can)) {
                  $this->Flash->success(__('You account has been verified, please login'));
                  return $this->redirect(['action' => 'login']);
              }
              
            } else {
                $this->Flash->error(__('Please, try again, or contact support'));
                return $this->redirect(['action' => 'contact']);
            }
        }
}

public function unsubscribe() {

        if ($this->request->is('post')) {
        
          if(GOOGLECAPTCHA == 1) {          
            if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLESECRETKEY.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            
              if(!$responseData->success == true) { 
                $this->Flash->error(__('Hi Cyborg you used the reCaptcha wrong!'));
                return $this->redirect($this->referer());
              }  
            
            } else {
              $this->Flash->error(__('Please use reCaptcha to tell us your are not a rogue cyborg'));
              return $this->redirect($this->referer());
            }           
          }  
        
            $user = $this->Auth->identify();
            if ($user) {
            
                $this->Auth->setUser($user);
                
                $user_id = $user['id'];
                $user_role_id = $user['role_id'];
                
      
                if($user_role_id == 1) { 
                  return $this->redirect(['plugin' => 'jobs', 'controller' => 'jobs', 'action' => 'index']);
                } else {
                 // return $this->redirect(REDIRECTURL);
                 return $this->redirect(['plugin' => null, 'controller' => 'portfolio', 'action' => 'index']);                  
                }
               // return $this->redirect($this->Auth->redirectUrl());              
            }
            $this->Flash->error(__('Invalid username or password or your account has not been approved yet. Please contact support'));
        }

    }
    
   


}