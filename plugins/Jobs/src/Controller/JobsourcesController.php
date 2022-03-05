<?php
namespace Jobs\Controller;

use Jobs\Controller\AppController;
use Cake\Event\Event;

/**
 * Jobsources Controller
 *
 * @property \Jobs\Model\Table\JobsourcesTable $Jobsources
 */
class JobsourcesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $jobsources = $this->paginate($this->Jobsources);

        $this->set(compact('jobsources'));
        $this->set('_serialize', ['jobsources']);
    }

    /**
     * View method
     *
     * @param string|null $id Jobsource id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $jobsource = $this->Jobsources->get($id, [
            'contain' => []
        ]);

        $this->set('jobsource', $jobsource);
        $this->set('_serialize', ['jobsource']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $jobsource = $this->Jobsources->newEntity();
        if ($this->request->is('post')) {
            $jobsource = $this->Jobsources->patchEntity($jobsource, $this->request->data);
            if ($this->Jobsources->save($jobsource)) {
                $this->Flash->success(__('The jobsource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jobsource could not be saved. Please, try again.'));
        }
        $this->set(compact('jobsource'));
        $this->set('_serialize', ['jobsource']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Jobsource id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $jobsource = $this->Jobsources->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jobsource = $this->Jobsources->patchEntity($jobsource, $this->request->data);
            if ($this->Jobsources->save($jobsource)) {
                $this->Flash->success(__('The jobsource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jobsource could not be saved. Please, try again.'));
        }
        $this->set(compact('jobsource'));
        $this->set('_serialize', ['jobsource']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Jobsource id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jobsource = $this->Jobsources->get($id);
        if ($this->Jobsources->delete($jobsource)) {
            $this->Flash->success(__('The jobsource has been deleted.'));
        } else {
            $this->Flash->error(__('The jobsource could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
