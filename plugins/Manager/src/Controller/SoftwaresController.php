<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Softwares Controller
 *
 * @property \App\Model\Table\SoftwaresTable $Softwares
 */
class SoftwaresController extends AppController
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
        
        $this->set('setstate', 'softwares');
        $this->viewBuilder()->layout('default');
        //$this->viewBuilder()->templatePath('Error');  
        
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
          
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        

        $this->paginate['order'] = ['Softwares.id' => 'DESC'];
        
        $softwares = $this->paginate($this->Softwares);

        $this->set(compact('softwares'));
        $this->set('_serialize', ['softwares']);
    }

    /**
     * View method
     *
     * @param string|null $id Software id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        
        $software = $this->Softwares->find('all', [ 
          'conditions' => ['slug' => $slug]
        ]);
        $software = $software->first();
        
        $this->loadModel('SoftwareDeployments');
        $softwareDeployments = $this->SoftwareDeployments->find('list', ['limit' => 200]);;        
        $this->loadModel('SoftwareSupports');
        $softwareSupports = $this->SoftwareSupports->find('list', ['limit' => 200]);
        $this->loadModel('SoftwareDemooptions');
        $softwareDemooptions = $this->SoftwareDemooptions->find('list', ['limit' => 200]);
        $this->loadModel('SoftwareTrainings');
        $softwareTrainings = $this->SoftwareTrainings->find('list', ['limit' => 200]);
        
        $this->loadModel('SoftwareFeatures');
        $softwareFeatures = $this->SoftwareFeatures
        ->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])
        ->where(['software_category_id =' => $software->software_category_id])
        ->toArray();
        
        $this->loadModel('SoftwarePricetypes');
        $priceperiod = $this->SoftwarePricetypes->get($software->software_pricetype_id);
        $priceperiod = $priceperiod->name;
        
        $currency = '';
        if( $software->currency_id > 0 ) {
        $this->loadModel('Currencies');
        $currency = $this->Currencies->get($software->currency_id);
        $currency = $currency->html_entity;
        }

        $this->set(compact('software', 'softwareDeployments', 'softwareSupports', 'softwareTrainings', 'softwareFeatures',  'softwareDemooptions', 'priceperiod', 'currency'));
        $this->set('_serialize', ['software']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }

        
        $software = $this->Softwares->newEntity();
        if ($this->request->is('post')) {
        
          
             
          $software = $this->Softwares->patchEntity($software, $this->request->data);
         
          
          $name = $this->request->data['name'];
          $name = strtolower($name);
          $name = ucwords($name);
          $software['name'] = $name;
            
          if(!empty($this->request->data['software_support_ids'])) {
          $support = $this->request->data['software_support_ids'];
           $list = '';
           foreach($support as $key => $id){
            $list .= $id.',';
           }
           $list = rtrim($list,',');
           
           $software['software_support'] = $list;
          } 
          
          if(!empty($this->request->data['software_deployment_ids'])) { 
          $deployment = $this->request->data['software_deployment_ids'];
           $list = '';
           foreach($deployment as $key => $id){
            $list .= $id.',';
           }
           $list = rtrim($list,',');
           
           $software['software_deployment'] = $list;
          }
       /*
          if(!empty($this->request->data['software_demo_ids'])) {
          $demo = $this->request->data['software_demo_ids'];
           $list = '';
           foreach($demo as $key => $id){
            $list .= $id.',';
           }
           $list = rtrim($list,',');
           
           $software['software_demooption'] = $list;
          }
        */
           
          if(!empty($this->request->data['software_training_ids'])) {
          $training = $this->request->data['software_training_ids'];
           $list = '';
           foreach($training as $key => $id){
            $list .= $id.',';
           }
           $list = rtrim($list,',');
           
           $software['software_training'] = $list;
          }

          if(!empty($this->request->data['software_feature_ids'])) {
          $features = $this->request->data['software_feature_ids'];
           $list = '';
           if(!empty($features)) {
             foreach($features as $key => $id){
              $list .= $id.',';
             }
             $list = rtrim($list,',');
             
             $software['software_features'] = $list;
           }
          }
          
            $this->loadComponent('slugcreator');
            $software['slug'] = $this->slugcreator->userslug($software['name']);
            
            $software['user_id'] = $user_id;
            
          if (!empty($this->request->data['theimage']['name'])) {
          
            $this->loadComponent('Image');
            $location = WWW_ROOT . '/img/software/';
            $image = $this->Image->uploadimage($location, $this->request->data['theimage']); 

            
            $this->Image->load($location.$image);
            $this->Image->makesquare_if_portrait();
            $this->Image->resizeToWidth(50);
            //$this->Image->crop(50,50);
            $this->Image->save($location.'small_'.$image); 
            
            $this->Image->load($location.$image);
            $this->Image->makesquare_if_portrait();
            $this->Image->resizeToWidth(100);
            //$this->Image->crop(100,100);
            $this->Image->save($location.'squared_'.$image);

           
            $this->Image->load($location.$image);
            $this->Image->makesquare_if_portrait();
            $this->Image->resizeToWidth(320);
            //$this->Image->crop(330,330);
            $this->Image->save($location.'postcard_'.$image);
            
             $software['theimage'] = $image;     
                            
          } 
          
          
           if(!empty($this->request->data['software_category_id'])) {
           
           $category_id = $this->request->data['software_category_id'];
           
            $this->loadModel('SoftwareFeatures');
            $softwareFeatures = $this->SoftwareFeatures
            ->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ])
            ->where(['software_category_id =' => $category_id])
            ->toArray();
            
            $this->set('softwareFeatures', $softwareFeatures);
          }
          
          
          $description = $this->request->data['long_description'];
          $description = $this->cleanhtml($description);
          $software['long_description'] = $description;
          $software['short_description'] = substr($description, 0, 350);
          
          if($this->request->data['pricedisplay'] == 1) {
            $software['price'] = 0;
            $software['currency_id'] = 0;
          }
          
          if($this->request->data['displayfeatures'] == 1) {
            $software['software_features'] = 0;
            $software['software_feature_ids'] = 0;
          }
          
          $software['status'] = 0;
          $software['priceperuser'] = 0;

            if ($this->Softwares->save($software)) {
            
      $titlelink =  '<a href="www.skillbooker.com/softwares/view/'.$software['slug'].'">'.$software['name'].'</a>';
                        
            $keys = array();
            $keys[] = $this->Auth->user('name');
            $keys[] = $titlelink;
            
            $sendvalues = array();
            $sendvalues['to'] = 'gabriel@skillbooker.com';
            $sendvalues['keys'] = $keys;
            $sendvalues['templateid'] = 23;
            $sendvalues['receiver_id'] = 1;
            $sendvalues['sender_id'] = 1;
            $sendvalues['logreceived'] = 'received';
      
      if(SENDMAIL == 1) {
      
            // email to user from site inform of project listed
            $this->loadComponent('Emailc');                  
            $emailc = $this->Emailc->send_email($sendvalues);
      } 
            
                $this->Flash->success(__('The software has been saved.'));
                return $this->redirect(['action' => 'lists']);
            }
            $this->Flash->error(__('The software could not be saved. Please, try again.'));
        }
        $softwarePricetypes = $this->Softwares->SoftwarePricetypes->find('list', ['limit' => 200]);
        $softwareCategories = $this->Softwares->SoftwareCategories->find('list');
        $currencies = $this->Softwares->Currencies->find('list', ['limit' => 200]);
        
        $this->loadModel('SoftwareDeployments');
        $softwareDeployments = $this->SoftwareDeployments->find('list', ['limit' => 200]);
        $this->loadModel('SoftwareSupports');
        $softwareSupports = $this->SoftwareSupports->find('list', ['limit' => 200]);
        $this->loadModel('SoftwareDemooptions');
        $softwareDemooptions = $this->SoftwareDemooptions->find('list', ['limit' => 200]);
        $this->loadModel('SoftwareTrainings');
        $softwareTrainings = $this->SoftwareTrainings->find('list', ['limit' => 200]);
        $this->set(compact('software', 'softwarePricetypes', 'softwareCategories',  'softwareDeployments', 'softwareSupports', 'softwareDemooptions', 'softwareTrainings', 'currencies'));
        $this->set('_serialize', ['software']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Software id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $software = $this->Softwares->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $software = $software->first();
        
        $theimage = $software->theimage;
        
        if(empty($software->id)){
            $this->Flash->error(__('Sorry, this software does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'softwares', 'action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $software = $this->Softwares->patchEntity($software, $this->request->data);
            
            
          $name = $this->request->data['name'];
          $name = strtolower($name);
          $name = ucwords($name);
          $software['name'] = $name;
            
        if(!empty($this->request->data['software_support_ids'])) {
          $support = $this->request->data['software_support_ids'];
           $list = '';
           foreach($support as $key => $id){
            $list .= $id.',';
           }
           $list = rtrim($list,',');
           
           $software['software_support'] = $list;
          } 
          
          if(!empty($this->request->data['software_deployment_ids'])) { 
          $deployment = $this->request->data['software_deployment_ids'];
           $list = '';
           foreach($deployment as $key => $id){
            $list .= $id.',';
           }
           $list = rtrim($list,',');
           
           $software['software_deployment'] = $list;
          }

          if(!empty($this->request->data['software_demo_ids'])) {
          $demo = $this->request->data['software_demo_ids'];
           $list = '';
           foreach($demo as $key => $id){
            $list .= $id.',';
           }
           $list = rtrim($list,',');
           
           $software['software_demooption'] = $list;
          }
           
          if(!empty($this->request->data['software_training_ids'])) {
          $training = $this->request->data['software_training_ids'];
           $list = '';
           foreach($training as $key => $id){
            $list .= $id.',';
           }
           $list = rtrim($list,',');
           
           $software['software_training'] = $list;
          }

          if(!empty($this->request->data['software_feature_ids'])) {
          $features = $this->request->data['software_feature_ids'];
           $list = '';
           if(!empty($features)) { 
             foreach($features as $key => $id){
              $list .= $id.',';
             }
             $list = rtrim($list,',');
             
             $software['software_features'] = $list;
           }
          }
          
            $this->loadComponent('slugcreator');
            $software['slug'] = $this->slugcreator->userslug($software['name']);
            
        $software['theimage'] = $theimage;
        
            
        if (!empty($this->request->data['theimage']['name'])) {

        
            $location = WWW_ROOT . '/img/software/';
            
            if(!empty($theimage)) {
            
            $deleteimg = $theimage;
            unlink($location.$deleteimg);
            $small = 'small_'.$deleteimg;
            unlink($location.$small);
            $squared = 'squared_'.$deleteimg;
            unlink($location.$squared);
            $postcard = 'postcard_'.$deleteimg;
            unlink($location.$postcard);
            
            }
          
            $this->loadComponent('Image');
            $image = $this->Image->uploadimage($location, $this->request->data['theimage']); 
            
            $this->Image->load($location.$image);
            $this->Image->makesquare_if_portrait();
            $this->Image->resizeToWidth(50);
            //$this->Image->crop(50,50);
            $this->Image->save($location.'small_'.$image); 
            
            $this->Image->load($location.$image);
            $this->Image->makesquare_if_portrait();
            $this->Image->resizeToWidth(100);
            //$this->Image->crop(100,100);
            $this->Image->save($location.'squared_'.$image);

           
            $this->Image->load($location.$image);
            $this->Image->makesquare_if_portrait();
            $this->Image->resizeToWidth(320);
            //$this->Image->crop(330,330);
            $this->Image->save($location.'postcard_'.$image);
            
             $software['theimage'] = $image;     
                       
          }
          
          $description = $this->request->data['long_description'];
          $description = $this->cleanhtml($description);
          $software['long_description'] = $description;
          $software['short_description'] = substr($description, 0, 350);
          
          if($this->request->data['pricedisplay'] == 1) {
            $software['price'] = 0;
            $software['currency_id'] = 0;
          } 
          
          if($this->request->data['displayfeatures'] == 1) {
            $software['software_features'] = 0;
            $software['software_feature_ids'] = 0;
          }
            
            
            if ($this->Softwares->save($software)) {
                $this->Flash->success(__('The software has been saved.'));

                return $this->redirect(['action' => 'lists']);
            }
            $this->Flash->error(__('The software could not be saved. Please, try again.'));
        }
        $softwarePricetypes = $this->Softwares->SoftwarePricetypes->find('list', ['limit' => 200]);
        $softwareCategories = $this->Softwares->SoftwareCategories->find('list');
        $currencies = $this->Softwares->Currencies->find('list', ['limit' => 200]);
                
        $this->loadModel('SoftwareDeployments');
        $softwareDeployments = $this->SoftwareDeployments->find('list', ['limit' => 200]);
        $this->loadModel('SoftwareSupports');
        $softwareSupports = $this->SoftwareSupports->find('list', ['limit' => 200]);
        $this->loadModel('SoftwareDemooptions');
        $softwareDemooptions = $this->SoftwareDemooptions->find('list', ['limit' => 200]);
        $this->loadModel('SoftwareTrainings');
        $softwareTrainings = $this->SoftwareTrainings->find('list', ['limit' => 200]);
        
        $this->loadModel('SoftwareFeatures');
        $softwareFeatures = $this->SoftwareFeatures
        ->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])
        ->where(['software_category_id =' => $software->software_category_id])
        ->toArray();
    
        
        
        $this->set(compact('software', 'softwarePricetypes', 'softwareCategories', 'softwareDeployments', 'softwareSupports', 'softwareDemooptions', 'softwareTrainings', 'softwareFeatures', 'currencies'));
        $this->set('_serialize', ['software']);
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Software id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $software = $this->Softwares->find('all', [ 
          'conditions' => ['slug' => $slug, 'user_id' => $user_id]
        ]);
        $software = $software->first(); 
        
        if(empty($software->id)){
            $this->Flash->error(__('Sorry, this software does not belong to you.'));
            return $this->redirect(['plugin' => null, 'controller' => 'softwares', 'action' => 'index']);
        }
        
        if(!empty($software->theimage)) {
                
            $location = WWW_ROOT . '/img/software/';
            $deleteimg = $software->theimage;
            unlink($location.$deleteimg);
            $small = 'small_'.$deleteimg;
            unlink($location.$small);
            $squared = 'squared_'.$deleteimg;
            unlink($location.$squared);
            $postcard = 'postcard_'.$deleteimg;
            unlink($location.$postcard); 
        }            
          
        
        if ($this->Softwares->delete($software)) {
            $this->Flash->success(__('The software has been deleted.'));
        } else {
            $this->Flash->error(__('The software could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'lists']);
    }
        
    
        public function getfeatures($id)
    {
        $this->viewBuilder()->layout('ajax');
        $this->loadModel('SoftwareFeatures');
        $features = $this->SoftwareFeatures->find('all',['conditions'=>['SoftwareFeatures.software_category_id' => $id]]);
        $this->set('features', $features);
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
  
  
    public function totwitter($id) {
  

    $software = $this->Softwares->find('all',['conditions'=>['id'=>$id]]);
    $software = $software->first();
  
    $twitterkeywordlist = '';
    
    $twitterkeywordlist = '#'.trim($software->name).' ';

    $this->loadModel('SoftwareCategories'); 
    $category = $this->SoftwareCategories->find('all',['conditions'=>['id'=>$software->software_category_id]]);
    $category = $category->first();
    $thecategory = $category->name;
   
    $twitterkeywordlist = '#'.trim($thecategory).' ';
    
    $list = '';
    $features = $software->software_features;
    $explode = explode(',', $features);
    
    foreach($explode as $key) {
     $list .= "'".$key."',";
    }
    
    $list = rtrim($list, ','); 

    if( $features != 0 ) {
      $this->loadModel('SoftwareFeatures'); 
      $results = $this->SoftwareFeatures->find('all',['conditions'=>['id IN ('.$list.')']]);
      foreach($results as $result){            
            $twitterkeywordlist .= '#'.trim($result->name).' ';
      }
    } 
  
    $this->loadComponent('Codebird');
    $codebird = $this->Codebird->setConsumerKey(TWITTERCONSUMERKEY, TWITTERCONSUMERKEYSECRET);
    $bird = $this->Codebird->getInstance();
    $bird->setToken(TWITTERACCESSTOKEN, TWITTERACCESSTOKENSECRET);
  
    $params = array('status' => $software->name.' http://www.skillbooker.com/softwares/view/'.$software->slug.'  '.$twitterkeywordlist);
    $reply = $bird->statuses_update($params); 
    

    if(!empty($reply->id)) {
    
      $Table = TableRegistry::get('Softwares');
      $update = $Table->get($software->id); 
      $update->twitter = $software->twitter + 1;
      $Table->save($update);
    
      $this->Flash->success(__('This software has been added to Twitter.'));
    
    } else {
      $this->Flash->error(__('Twitter adding error.'));
    }
    
      return $this->redirect(['action' => 'index']);

  }
  
    public function twitterloop() {
  

    $softwares = $this->Softwares->find('all',['conditions'=>['twitter'=>0]]);
    foreach($softwares as $software) {

     sleep(3);
     
    $twitterkeywordlist = '';

    $this->loadModel('SoftwareCategories'); 
    $category = $this->SoftwareCategories->find('all',['conditions'=>['id'=>$software->software_category_id]]);
    $category = $category->first();
    $thecategory = $category->name;
   
    $twitterkeywordlist = '#'.trim($thecategory).' ';
    
    $list = '';
    $features = $software->software_features;
    $explode = explode(',', $features);
    
    foreach($explode as $key) {
     $list .= "'".$key."',";
    }
    
    $list = rtrim($list, ','); 

    if( $features != 0 ) {
      $this->loadModel('SoftwareFeatures'); 
      $results = $this->SoftwareFeatures->find('all',['conditions'=>['id IN ('.$list.')']]);
      foreach($results as $result){            
            $twitterkeywordlist .= '#'.trim($result->name).' ';
      }
    } 
  
    $this->loadComponent('Codebird');
    $codebird = $this->Codebird->setConsumerKey(TWITTERCONSUMERKEY, TWITTERCONSUMERKEYSECRET);
    $bird = $this->Codebird->getInstance();
    $bird->setToken(TWITTERACCESSTOKEN, TWITTERACCESSTOKENSECRET);
  
    $params = array('status' => $software->name.' http://www.skillbooker.com/softwares/view/'.$software->slug.'  '.$twitterkeywordlist);
    $reply = $bird->statuses_update($params); 
    

    if(!empty($reply->id)) {
    
      $Table = TableRegistry::get('Softwares');
      $update = $Table->get($software->id); 
      $update->twitter = $software->twitter + 1;
      $Table->save($update);
      $this->Flash->error(__('Twitter adding error.'));
    }
    }
  }
    
}
