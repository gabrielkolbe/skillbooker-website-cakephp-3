<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * EmailLayouts Controller
 *
 * @property \Eventbooker\Model\Table\EmailLayoutsTable $EmailLayouts
 */
class EmailLayoutsController extends AppController
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
        $emailLayouts = $this->paginate($this->EmailLayouts);

        $this->set(compact('emailLayouts'));
        $this->set('_serialize', ['emailLayouts']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Layout id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailLayout = $this->EmailLayouts->get($id, [
            'contain' => []
        ]);

        $this->set('emailLayout', $emailLayout);
        $this->set('_serialize', ['emailLayout']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailLayout = $this->EmailLayouts->newEntity();
        if ($this->request->is('post')) {
            $emailLayout = $this->EmailLayouts->patchEntity($emailLayout, $this->request->data);
            
            $name = $this->request->data['name'];
            $layout = $this->request->data['layout'];
            
            $key = '{{CONTENT}}';            
            $value = '<?php echo $this->fetch("content"); ?>';
            $layout = str_replace($key, $value, $layout);

            $key = '{{TITLE}}';
            $value = '<?php echo $this->fetch("title"); ?>';
            $layout = str_replace($key, $value, $layout);

    
                        
            $fp = fopen("../src/Template/Layout/Email/html/".$name.".ctp","wb");
            fwrite($fp,$layout);
            fclose($fp);
            
            $fpt = fopen("../src/Template/Layout/Email/text/".$name.".ctp","wb");
            fwrite($fpt,'<?php echo $this->fetch("content"); ?>');
            fclose($fpt);
            
            if ($this->EmailLayouts->save($emailLayout)) {
            
                $this->Flash->success(__('The email layout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email layout could not be saved. Please, try again.'));
        }
        $this->set(compact('emailLayout'));
        $this->set('_serialize', ['emailLayout']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Layout id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailLayout = $this->EmailLayouts->get($id, [
            'contain' => []
        ]);
        
       $oldname = $emailLayout->name;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailLayout = $this->EmailLayouts->patchEntity($emailLayout, $this->request->data);
            
            
            $name = $this->request->data['name'];
            $layout = $this->request->data['layout'];
            
            unlink("../src/Template/Layout/Email/html/".$oldname.".ctp");
            unlink("../src/Template/Layout/Email/text/".$oldname.".ctp");

            $key = '{{CONTENT}}';            
            $value = '<?php echo $this->fetch("content"); ?>';
            $layout = str_replace($key, $value, $layout);

            $key = '{{TITLE}}';
            $value = '<?php echo $this->fetch("title"); ?>';
            $layout = str_replace($key, $value, $layout);   
                        
            $fp = fopen("../src/Template/Layout/Email/html/".$name.".ctp","wb");
            fwrite($fp,$layout);
            fclose($fp);
            
            $fpt = fopen("../src/Template/Layout/Email/text/".$name.".ctp","wb");
            fwrite($fpt,'<?php echo $this->fetch("content"); ?>');
            fclose($fpt);
  
            
            if ($this->EmailLayouts->save($emailLayout)) {
                $this->Flash->success(__('The email layout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email layout could not be saved. Please, try again.'));
        }
        $this->set(compact('emailLayout'));
        $this->set('_serialize', ['emailLayout']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Layout id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailLayout = $this->EmailLayouts->get($id);
        
        $name = $emailLayout->name;
        
        unlink("../src/Template/Layout/Email/html/".$name.".ctp");
        unlink("../src/Template/Layout/Email/text/".$name.".ctp");  
        
        if ($this->EmailLayouts->delete($emailLayout)) {
            $this->Flash->success(__('The email layout has been deleted.'));
        } else {
            $this->Flash->error(__('The email layout could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
