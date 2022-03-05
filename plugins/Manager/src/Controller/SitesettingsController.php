<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * Sitesettings Controller
 *
 * @property \App\Model\Table\SitesettingsTable $Sitesettings
 */
class SitesettingsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'manager');        
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
        $sitesetting = $this->Sitesettings->get(1);
        
        $favicon = $sitesetting->favicon;
        $logo = $sitesetting->logo;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
      
        
        $sitesetting = $this->Sitesettings->patchEntity($sitesetting, $this->request->data);
    
          if (!empty($this->request->data['favicon']['name'])) {
                unlink('favicon.ico');
                $name = $this->request->data['favicon']['name'];
                $file = $this->request->data['favicon'];
                $ext = substr(strtolower(strrchr($name, '.')), 1); 
            
                $setNewFileName = 'favicon';
              
                if ($ext == 'ico') {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT  . $setNewFileName . '.' . $ext);
                    $imageFileName = $setNewFileName . '.' . $ext;
                    
                    $sitesetting->favicon = $imageFileName;
                    
                } else {
                  $this->Flash->error(__('Favicon extention has to be .ico'));
                  return $this->redirect(['action' => 'index']);
                }
          } else {
            $sitesetting->favicon = $favicon;
          }

          if (!empty($this->request->data['logo']['name'])) {          
            
              $this->loadComponent('Image');
              $location = WWW_ROOT . '/img/';
              $image = $this->Image->uploadimage($location, $this->request->data['logo']);        
    
                if(!empty($image)){
                  
                  $this->Image->load($location.$image);
                  $this->Image->resizeToWidth(200);
                  
                  $sitesetting->logo = $image;    
                      
                } else {
                    $this->Flash->error(__('Image was not uploaded: has to be jpg, jpeg, gif or png'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
              $sitesetting->logo = $logo;
            } 
            
            $sitesetting->defaultemail = trim(strtolower($sitesetting->defaultemail));
            
            if ($this->Sitesettings->save($sitesetting)) {
                $this->Flash->success(__('The sitesetting has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sitesetting could not be saved. Please, try again.'));
            }
        }
        
        $themes = $this->Sitesettings->Themes->find('list');
        $countries = $this->Sitesettings->Countries->find('list');
        $states = $this->Sitesettings->States->find('list');
        
        $this->set(compact('sitesetting','countries','states','themes'));
        $this->set('_serialize', ['sitesetting']);
    }
    
    public function deletelogo($id)
    {
        $site = $this->Sitesettings->get($id);
        //return debug($image->name);
        
        $location = WWW_ROOT . '/img/';
        unlink($location.$site->logo);
        $site->logo = '';
        
        if ($this->Sitesettings->save($site)) {
                $this->Flash->success(__('The logo has been deleted.'));
        } else {
            $this->Flash->error(__('The logo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
        public function deletefavicon($id)
    {
        $site = $this->Sitesettings->get($id);
        
        $location = '../../favicon.ico';
        unlink($location);
        
        $site->favicon = '';
        
        if ($this->Sitesettings->save($site)) {
                $this->Flash->success(__('The favicon has been deleted.'));
        } else {
            $this->Flash->error(__('The favicon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
