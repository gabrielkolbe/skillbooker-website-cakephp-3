<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;

/**
 * TutorialImages Controller
 *
 * @property \Manager\Model\Table\TutorialImagesTable $TutorialImages
 */
class TutorialImagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'tutorials');  
        
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
        $this->paginate = [
            'contain' => ['Tutorials']
        ];
        $tutorialImages = $this->paginate($this->TutorialImages);

        $this->set(compact('tutorialImages'));
        $this->set('_serialize', ['tutorialImages']);
    }

    /**
     * View method
     *
     * @param string|null $id Tutorial Image id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tutorialImage = $this->TutorialImages->get($id, [
            'contain' => ['Tutorials']
        ]);

        $this->set('tutorialImage', $tutorialImage);
        $this->set('_serialize', ['tutorialImage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tutorialImage = $this->TutorialImages->newEntity();
        if ($this->request->is('post')) {
            $tutorialImage = $this->TutorialImages->patchEntity($tutorialImage, $this->request->data);
            if ($this->TutorialImages->save($tutorialImage)) {
                $this->Flash->success(__('The tutorial image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial image could not be saved. Please, try again.'));
        }
        $tutorials = $this->TutorialImages->Tutorials->find('list', ['limit' => 200]);
        $this->set(compact('tutorialImage', 'tutorials'));
        $this->set('_serialize', ['tutorialImage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tutorial Image id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tutorialImage = $this->TutorialImages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tutorialImage = $this->TutorialImages->patchEntity($tutorialImage, $this->request->data);
            if ($this->TutorialImages->save($tutorialImage)) {
                $this->Flash->success(__('The tutorial image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tutorial image could not be saved. Please, try again.'));
        }
        $tutorials = $this->TutorialImages->Tutorials->find('list', ['limit' => 200]);
        $this->set(compact('tutorialImage', 'tutorials'));
        $this->set('_serialize', ['tutorialImage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tutorial Image id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tutorialImage = $this->TutorialImages->get($id);
        if ($this->TutorialImages->delete($tutorialImage)) {
            $this->Flash->success(__('The tutorial image has been deleted.'));
        } else {
            $this->Flash->error(__('The tutorial image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
