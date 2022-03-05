<?php

namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

public function beforeFilter(Event $event)
{
          parent::beforeFilter($event);
          $this->Auth->allow();
          $this->viewBuilder()->layout('front');
}


public function index($slug)
{        
      $this->loadModel('Custompages');
       
      $customs = $this->Custompages->find('all', [
            'conditions' => ['Custompages.slug' => $slug],                 
        ]);
        
      if ($customs->isEmpty()) {
        $this->Flash->error(__('Sorry, there are no such page'));
        return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
      }
      
        $custom = $customs->first();
        
      $this->set('custom', $custom);
      
       $this->render('/Pages/'.$custom['layout']); 
                            
}


public function slider()
{ 
		$this->loadModel('SliderImages');
		$sliderimage = $this->SliderImages->find('all',['conditions'=>['album_id'=>36,'status'=>1], 'fields'=>['title', 'image'],'order'=>'created desc']);
		$this->set('sliderimage',$sliderimage);
    
}

public function layeredslider()
{ 
		$imagelocation = '/img/layeredslider/';
    $this->set('imagelocation',$imagelocation);
    
}

public function home()
{ 
		$imagelocation = '/img/layeredslider/';
    $this->set('imagelocation',$imagelocation);
    
}
  
}
