<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Companies Controller
 *
 * @property \Jobs\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'jobs');  
        
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
            'contain' => ['Contactmethods']
        ];
        $companies = $this->paginate($this->Companies);

        $this->set(compact('companies'));
        $this->set('_serialize', ['companies']);
    }

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => ['Jobs']
        ]);

        $this->set('company', $company);
        $this->set('_serialize', ['company']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $company = $this->Companies->newEntity();
        if ($this->request->is('post')) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            
          $this->loadModel('Contactmethods');
          $contactmethod = $this->Contactmethods
            ->find()
            ->where(['id' => $this->request->data['contactmethod_id']])
            ->first();
          
          $company->display_contactmethod = $contactmethod->method;
          
          
          $this->loadModel('Countries');
          $countries = $this->Countries
            ->find()
            ->where(['id' => $this->request->data['country_id']])
            ->first();
          
          $company->display_country = $countries->name;
          
          $this->loadModel('States');
          $states = $this->States
            ->find()
            ->where(['id' => $this->request->data['state_id']])
            ->first();
          
          $company->display_state = $states->name;    
            
            
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }

        $contactmethods = $this->Companies->Contactmethods->find('list');
        $countries = $this->Companies->Countries->find('list');
        $this->set(compact('company', 'contactmethods',  'countries'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $company = $this->Companies->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            
          $this->loadModel('Contactmethods');
          $contactmethod = $this->Contactmethods
            ->find()
            ->where(['id' => $this->request->data['contactmethod_id']])
            ->first();
          
          $company->display_contactmethod = $contactmethod->method;
          
          
          $this->loadModel('Countries');
          $countries = $this->Countries
            ->find()
            ->where(['id' => $this->request->data['country_id']])
            ->first();
          
          $company->display_country = $countries->name;
          
          $this->loadModel('States');
          $states = $this->States
            ->find()
            ->where(['id' => $this->request->data['state_id']])
            ->first();
          
          $company->display_state = $states->name;    
            
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }
        $contactmethods = $this->Companies->Contactmethods->find('list');
        $countries = $this->Companies->Countries->find('list');
        $this->set(compact('company', 'contactmethods',  'countries'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
