<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/**w
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class FacebookController extends AppController
{

        public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
           
        //define('FB_APP_ID', '312246163067172');
        //define('FB_APP_SECRET', 'cc215632f8ea6008b095fbbeab3eac67');
        define('FB_APP_ID', '1155311941152419');
        define('FB_APP_SECRET', '77f10491160ef7ce11e7e7c63f1006ab');
        define('FB_REDIRECT_URL', 'https:://skillbooker.com/facebook');

        require_once(ROOT . DS . 'vendor' . DS . 'facebook' . DS . 'graph-sdk' . DS . 'src'. DS . 'Facebook' . DS . 'autoload.php');  

    }
    

      public function launch()
    {   

        //https://www.codexworld.com/login-with-facebook-using-php/

        $fb = new Facebook(array(
            'app_id' => FB_APP_ID,
            'app_secret' => FB_APP_SECRET,
            'default_graph_version' => 'v3.2',
        ));

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        $loginUrl = $helper->getLoginUrl(FB_REDIRECT_URL, $permissions);

       var_dump($loginUrl);
       die;

       return $this->redirect($loginUrl);

    }


          public function index()
    {

        if(isset($_GET)){ 
          
            var_dump($_GET);
            die;
        } 


    }





 
}