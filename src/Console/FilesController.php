<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Files Controller
 *                                                                     
 * @property \App\Model\Table\FilesTable $Files
 */
class FilesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
          $this->Auth->allow();
        
        $this->viewBuilder()->layout('frontsingle');
        
    }
    
    public function isAuthorized($user)
    {
    
        if (isset($user['role_id']) && $user['role_id'] == '1') {
            return true;             
        }
        
         return parent::isAuthorized($user);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function myfiles()   {

        $user_id = $this->Auth->user('id');
        
        if (empty($user_id)) {
            $this->Flash->success(__('Please login to access this page.'));
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        
        $this->paginate = [
            'conditions' => ['Files.user_id' => $user_id],
            'order' => ['Files.id DESC'] 
        ];

        $files = $this->paginate($this->Files);
        

        $this->set(compact('files'));
        $this->set('_serialize', ['files']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEntity();
        
        $this->loadModel('FilesExtentions');        
        $extentions = $this->FilesExtentions->find('all', [
          'fields' => ['FilesExtentions.extentionname'],         
        ]);
        
        $displayextentionlist = '';
        $allowedExts = array();
        foreach($extentions as $ext){
          $displayextentionlist .= ' .'.$ext->extentionname.' ';
          array_push($allowedExts, $ext->extentionname);
        }


        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->data);
            
            $user_id = $this->Auth->user('id');
            
          if (!empty($this->request->data['thefile']['name'])) {

      
          $temp = explode(".", $_FILES["thefile"]["name"]);
          
          $newfilename = round(microtime(true)).'.'. end($temp);
          
          if ( is_uploaded_file( $_FILES['thefile']['tmp_name'] ) ){
          
          $extension = explode(".", $_FILES["thefile"]["name"]);
          $extension = end($extension);
         // return debug($extension);
            
            if ( ( in_array($extension, $allowedExts ) ) ) {
            
            $location = WWW_ROOT . '/files/';
                if (move_uploaded_file($_FILES['thefile']  ['tmp_name'],"$location".$newfilename)){
                
                  $this->loadComponent('General');
                  
                  $file->filename = $_FILES["thefile"]["name"];
                  $file->thefile =  $newfilename;
                  $bytes = $this->General->formatBytes($_FILES["thefile"]["size"], $precision = 2);
                  $file->thesize = $bytes;
                  $file->user_id = $user_id;
                  
                  if ($this->Files->save($file)) {
                    $this->Flash->success(__('The File has been saved.'));
                      return $this->redirect(['controller' => 'files', 'action' => 'myfiles']);
                  } else {
                    $this->Flash->error(__('The file could not be saved. Please, try again.'));
                  }
                } else {
                  $this->Flash->error(__('The File could not be uploaded'));
                }
              } else {
                  $this->Flash->error(__('The File was not uploaded: It has to be: '.$displayextentionlist));
              }
          } 
                    

      } else {
          $this->Flash->error(__('The file could not be saved. Please, try again.'));
      }
  }
  

        
        $this->set(compact('file', 'displayextentionlist'));
        $this->set('_serialize', ['file']);
}


    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
        

        unlink(WWW_ROOT . '/files/'.$file->thefile);
        
            $this->Flash->success(__('The file has been deleted.'));
    
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'myfiles']);
    }
    
   public function download($thefile){
    $file_path = WWW_ROOT.'files'.DS.$thefile;
    $this->response->file($file_path, array(
        'download' => true,
        'name' => $thefile,
    ));
    return debug($this->response);
    return $this->response;
} 


}
