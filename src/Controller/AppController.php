<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Cache\Cache;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{ 

    public function beforeFilter(Event $event)
    { 
    
    //if($_SERVER['REQUEST_SCHEME'] == "http") { return $this->redirect('https://' . env('SERVER_NAME') . $this->here); } 
    
    $this->set('setstate', 'projects');
    
    $session = $this->request->session();
    
    if(($session->check('industry')) == false){
      $session->write('industry',DEFAULT_INDUSTRY);
    }
    if(($session->check('industry_id')) == false){
      $session->write('industry_id',DEFAULT_INDUSTRYID);
    }
    
    if(($session->check('country')) == false){
      $session->write('country',DEFAULT_COUNTRY);
    }
    if(($session->check('country_id')) == false){
      $session->write('country_id',DEFAULT_COUNTRYID);
    }
          
    }
  

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
	      $this->loadComponent('RequestHandler');
         //for json and ajax 16/03

        $this->loadComponent('Flash');
    
 
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password',
                    ],
                    'scope' => ['Users.status' => '1'],
                ],
            ],
            'loginAction' => [
                'plugin' => false,
                'controller' => 'Users',
                'action' => 'login',
            ],
            'loginRedirect' => '/',
            'logoutRedirect' => '/',
            'unauthorizedRedirect' => false,
            'authError' => __('You must be logged in to access this page'),
            'storage' => 'Session',
        ]);

        // verification if logged and set variable
      //  $this->set('current_user', $this->Auth->user());
       

    }
    

    public function isAuthorized($user)
    {
        //the default
        return false; 
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        } 
    }
    
    

}
