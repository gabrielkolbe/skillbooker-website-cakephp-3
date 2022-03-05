<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
//use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Messengers Controller
 *
 * @property \App\Model\Table\MessengersTable $Messengers
 */
class MessengerController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'activity');
        $this->viewBuilder()->layout('frontside');   
    }
    
    public function isAuthorized($user)
    {
    
      if(is_null($this->Auth->user('id'))){
          $this->Flash->success(__('Please login to access this page.'));
          return $this->redirect(['controller' => 'users', 'action' => 'login']);
      } else {
          return true;
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

   
        $this->loadModel('Messengers');
        $messengers = $this->Messengers->find('all', [
          'fields' => ['Sender.name', 'Sender.slug', 'Receiver.name', 'Receiver.slug', 'Messengers.id', 'Messengers.sender_id', 'Messengers.receiver_id','Messengers.title', 'Messengers.created'],
          'conditions' => ['Messengers.user_id' => $user_id],
          'join' => [
                    [
                      'table' => 'users',
                      'alias' => 'Receiver',
                      'type' => 'LEFT',
                      'conditions' => [
                      'Receiver.id = Messengers.receiver_id'
                      ]
                    ],
                    [
                      'table' => 'users',
                      'alias' => 'Sender',
                      'type' => 'LEFT',
                      'conditions' => [
                      'Sender.id = Messengers.sender_id'
                      ]
                    ],
                    
          ],
         'order' => ['Messengers.id' => 'DESC']    
        ]);
              
       $messengers = $this->paginate($messengers);

        $this->set(compact('messengers', 'user_id'));
        $this->set('_serialize', ['messengers']);
    }
  

    /**
     * View method
     *
     * @param string|null $id Messenger id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('ajax');   
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->loadModel('Messengers');
        $messenger = $this->Messengers->find('all', [
          'fields' => ['Receiver.name', 'Receiver.slug', 'Messengers.id', 'Messengers.title', 'Messengers.message', 'Messengers.created'],
          'conditions' => ['Messengers.user_id' => $user_id, 'Messengers.id' => $id],
          'join' => [
                    [
                      'table' => 'users',
                      'alias' => 'Receiver',
                      'type' => 'LEFT',
                      'conditions' => [
                      'Receiver.id = Messengers.receiver_id'
                      ]
                    ]
          ]  
        ]);
        
        $messenger = $messenger->first();

        $this->set('messenger', $messenger);
        $this->set('_serialize', ['messenger']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Messenger id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }        
        
        $this->loadModel('Messengers');
        $messenger = $this->Messengers->find('all', [
          'conditions' => ['Messengers.user_id' => $user_id, 'Messengers.id' => $id]   
        ]);
        
        $messenger = $messenger->first();
        
        if ($this->Messengers->delete($messenger)) {
            $this->Flash->success(__('The messenger has been deleted.'));
        } else {
            $this->Flash->error(__('The messenger could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
        public function reply($id = null)
    {
        $this->viewBuilder()->layout('ajax');   
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $user_id = $this->Auth->user('id');
        }
        
        $this->loadModel('Messengers');
        $messenger = $this->Messengers->find('all', [
          'fields' => ['Messengers.id', 'Sender.name', 'Sender.slug'],
          'conditions' => ['Messengers.user_id' => $user_id, 'Messengers.id' => $id],
          'join' => [
                    [
                      'table' => 'users',
                      'alias' => 'Sender',
                      'type' => 'LEFT',
                      'conditions' => [
                      'Sender.id = Messengers.sender_id'
                      ]
                    ]
          ]
        ]);

        $messenger = $messenger->first();
         
        $slug = $messenger->Sender['slug'];              
        $name = $messenger->Sender['name'];
        
        $this->set('slug', $slug);
        $this->set('name', $name);
        
        $this->render('/Messenger/sendemail'); 
    }
    
public function contactuser($slug) {
      
      $this->viewBuilder()->layout('ajax');

      $this->loadModel('Users');  
      $user = $this->Users->find('all', [ 
          'conditions' => ['slug' => $slug]
        ]);
      $user = $user->first();
      
      $name = $user->name;
      $slug = $user->slug;
      
      $this->set('slug', $slug);
      $this->set('name', $name);
     
    $this->render('/Messenger/sendemail'); 
}
    
  

public function sendemailaction() {

      if ($this->request->is('post')) {
      
        if(is_null($this->Auth->user('id'))) {
            $this->Flash->error(__('Please login to access this page.'));
            return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        } else {
            $sender_slug = $this->Auth->user('slug');
        }
      
        $receiver_slug = $this->request->data['receiver_slug'];
      
        $this->loadModel('Users');  
        $sender = $this->Users->find('all', [ 
            'conditions' => ['slug' => $sender_slug]
          ]);
        $sender = $sender->first();
        
        $receiver = $this->Users->find('all', [ 
            'conditions' => ['slug' => $receiver_slug]
          ]);
        $receiver = $receiver->first();
        
        $title = $this->request->data['title'];
        $message = $this->request->data['message'];

        $Table = TableRegistry::get('Messengers');
        $savesend = $Table->newEntity();
        
        $savesend->user_id = $sender->id;
        $savesend->sender_id = $sender->id;
        $savesend->receiver_id = $receiver->id;
        $savesend->direction = 'sent';
        $savesend->sender_email = $sender->email;
        $savesend->receiver_email= $receiver->email;
        $savesend->title = $title;
        $savesend->message = $message;
        $savesend->created = date("Y-m-d H:i:s"); 
        $savesend->modified = date("Y-m-d");
                 
        if ($Table->save($savesend)) {

            $keys = array();
            $keys[] = $sender->name;
            $keys[] = $receiver->name;
            $keys[] = $title;
            $keys[] = $message;
    					
            $sendvalues = array();
            $sendvalues['to'] = $receiver->email;
            $sendvalues['from'] = DEFAULT_SITE_EMAIL;  //non needed
            $sendvalues['keys'] = $keys;
            $sendvalues['subject'] = 'Message from '.$sender->name.' on '.SITE; 
            $sendvalues['templateid'] = 5;


        if(SENDMAIL == 1) {          
            $this->loadComponent('Emailc');           
            $emailc = $this->Emailc->send_email($sendvalues);
        }    
        
  
            $savereceive = $Table->newEntity();
                
            $savereceive->user_id = $receiver->id;
            $savereceive->sender_id = $sender->id;
            $savereceive->receiver_id = $receiver->id;
            $savereceive->direction = 'received';
            $savereceive->sender_email = $sender->email;
            $savereceive->receiver_email= $receiver->email;
            $savereceive->title = $this->request->data['title'];
            $savereceive->message = $this->request->data['message'];
            $savereceive->created = date("Y-m-d H:i:s"); 
            $savereceive->modified = date("Y-m-d");
          
            if ($Table->save($savereceive)) {
          
              $this->Flash->success(__('Your email has been sent'));
              return $this->redirect(['plugin'=>null, 'controller'=>'messenger', 'action' => 'index']);
              
            } else {
            
                $this->Flash->error(__('Sorry, your email was not logged in messenger'));
                return $this->redirect(['plugin'=>null, 'controller'=>'messenger', 'action' => 'index']);
            
            }
    
          } else {
                $this->Flash->error(__('Sorry, your email could not be sent'));
                return $this->redirect(['plugin'=>null, 'controller'=>'messenger', 'action' => 'index']);
          }
          
        }
        
}

                    
}
