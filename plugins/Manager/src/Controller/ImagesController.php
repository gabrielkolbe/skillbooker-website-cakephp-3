<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;


/**
 * Images Controller
 *
 * @property \App\Model\Table\ImagesTable $Images
 */
class ImagesController extends AppController
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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'order' => ['Images.id' => 'DESC']            
        ];
        
        $images = $this->paginate($this->Images);

        $this->set(compact('images'));
        $this->set('_serialize', ['images']);
    }

    /**
     * View method
     *
     * @param string|null $id Image id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $image = $this->Images->get($id, [
        ]);

        $this->set('image', $image);
        $this->set('_serialize', ['image']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $image = $this->Images->newEntity();
        if ($this->request->is('post')) {
            $image = $this->Images->patchEntity($image, $this->request->data);
            
                if (!empty($this->request->data['theimage']['name'])) {
                  
                    $this->loadComponent('Image');
                    $location = WWW_ROOT . '/img/';
                    $uploaded_image = $this->Image->uploadimage($location, $this->request->data['theimage']);        
                    //return debug($uploaded_image); 
                      if(!empty($uploaded_image)){
                      $image->name = $uploaded_image;
                      $image->event_id = 0;
                      
                        $this->Image->load($location.$uploaded_image);
                        $width = $this->Image->getWidth();
                        $height = $this->Image->getHeight();
                      
                      $image->width = $width;
                      $image->height = $height;  
                              
                      } else {
                          $this->Flash->error(__('Image was not uploaded: has to be jpg, jpeg, gif or png'));
                          return $this->redirect(['action' => 'index']);
                      }
                      
                      $this->Image->load($location.$uploaded_image);
                      $this->Image->resizeToWidth(50);
                      $this->Image->save($location.'small_'.$uploaded_image); 
                      
                      $this->Image->load($location.$uploaded_image);
                      $this->Image->crop(230, 150);
                      $this->Image->save($location.'squared_'.$uploaded_image);
                      
                      $this->Image->load($location.$uploaded_image);
                      $this->Image->crop(400, 270);
                      $this->Image->save($location.'postcard_'.$uploaded_image);     
                      
                  } 
                     
            if ($this->Images->save($image)) {
                $this->Flash->success(__('The image has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The image could not be saved. Please, try again.'));
            }
        }
        
        $this->loadModel('ImageTypes');
        $types = $this->ImageTypes->find('list', ['limit' => 200]);
        $this->set(compact('image', 'types'));
        $this->set('_serialize', ['image']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Image id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $image = $this->Images->get($id);
        //return debug($image->name);
        if ($this->Images->delete($image)) {
        
        $location = WWW_ROOT . '/img/';
        unlink($location.$image->name);
        $small = 'small_'.$image->name;
        unlink($location.$small);
        $squared = 'squared_'.$image->name;
        unlink($location.$squared);
        $postcard = 'postcard_'.$image->name;
        unlink($location.$postcard);
        
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
        public function showhide($slug)
    {
    
    if(empty($slug)) {            
            $this->Flash->error(__('Ooops some paramentes missing'));
            return $this->redirect(['action' => 'index']);
    }
    
    $action = explode('_', $slug);
    
    $image = $this->Images->get($action[1]);
        
    if($action[0] == 'hide'){ $image->showphotowall = 0; } elseif($action[0] == 'show') { $image->showphotowall = 1;} else {}
    
            if ($this->Images->save($image)) {
                $this->Flash->success(__('Photo wall images has been updated.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Oops there was a problem.'));
                return $this->redirect(['action' => 'index']);
            }

    }
    
}
