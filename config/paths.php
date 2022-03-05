<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Use the DS to separate the directories in other defines
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/**
 * These defines should only be edited if you have cake installed in
 * a directory layout other than the way it is distributed.
 * When using custom settings be sure to use the DS and do not add a trailing DS.
 */

/**
 * The full path to the directory which holds "src", WITHOUT a trailing DS.
 */
define('ROOT', dirname(__DIR__));

/**
 * The actual directory name for the application directory. Normally
 * named 'src'.
 */
define('APP_DIR', 'src');

/**
 * Path to the application's directory.
 */
define('APP', ROOT . DS . APP_DIR . DS);

/**
 * Path to the config directory.
 */
define('CONFIG', ROOT . DS . 'config' . DS);

/**
 * File path to the webroot directory.
 */
define('WWW_ROOT', ROOT . DS . 'webroot' . DS);

/**
 * Path to the tests directory.
 */
define('TESTS', ROOT . DS . 'tests' . DS);

/**
 * Path to the temporary files directory.
 */
define('TMP', ROOT . DS . 'tmp' . DS);

/**
 * Path to the logs directory.
 */
define('LOGS', ROOT . DS . 'logs' . DS);

/**
 * Path to the cache files directory. It can be shared between hosts in a multi-server setup.
 */
define('CACHE', TMP . 'cache' . DS);

/**
 * The absolute path to the "cake" directory, WITHOUT a trailing DS.
 *
 * CakePHP should always be installed with composer, so look there.
 */
define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'vendor' . DS . 'cakephp' . DS . 'cakephp');

/**
 * Path to the cake directory.
 */
define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
define('CAKE', CORE_PATH . 'src' . DS);


define('DEFAULT_SITE_URL', 'https://www.skillbooker.com');
define('DEFAULT_SITE_ID', '1');


define('DEFAULT_HOST', 'localhost');

if($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
 define('DEFAULT_DATABASE_PASSWORD', '');
 define('ROOTURL', 'skillbooker/');
 define('DEFAULT_DATABASE_USER', 'root');
 define('DEFAULT_DATABASE', 'skillbooker');
} else {
 define('DEFAULT_DATABASE_PASSWORD', '70NewYattrd');
  define('ROOTURL', 'http://www.skillbooker.com');
  define('DEFAULT_DATABASE_USER', 'pkulspjn');
  define('DEFAULT_DATABASE', 'pkulspjn_skillbooker');
}

$conn = new mysqli(DEFAULT_HOST, DEFAULT_DATABASE_USER, DEFAULT_DATABASE_PASSWORD, DEFAULT_DATABASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `sitesettings` WHERE id = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

define('SITE', $row['site']);
define('DOMAIN', $row['domain']);

define('MODE', $row['mode']);
define('SANDBOX', $row['paypalsandbox']);
define('DEFAULT_SITE_EMAIL', $row['default_email']);
define('DEFAULT_SEO_DESCRIPTION', $row['seodescription']);
define('DEFAULT_SITE_DESCRIPTION', $row['description']);
define('DEFAULT_SITE_KEYWORDS', $row['keywords']);
define('DEFAULT_PAGETITLE', $row['default_pagetitle']);
define('REDIRECTURL', $row['redirecturl']);
define('HOMEURL', $row['homeurl']);
define('DEFAULT_SITE_ADDRESS', $row['default_address']);
define('DEFAULT_COUNTRYID', $row['country_id']);
define('DEFAULT_COUNTRY', 'United Kingdom');
define('DEFAULT_STATEID', $row['state_id']);
define('MAILHOST', $row['mailhost']);
define('MAILUSER', $row['mailuser']);
define('MAILPASSWORD', $row['mailpassword']);
define('MAILPORT', $row['mailport']);
define('MAILTYPE', $row['mailtype']);
define('GOOGLESITEKEY', $row['googlesitekey']);
define('GOOGLESECRETKEY', $row['googlesecretkey']);
define('GOOGLECAPTCHA', $row['googlecaptcha']);
define('TWITTERFEED', $row['twitterfeed']);
define('FACEBOOKAPPSECRET', $row['facebookappsecret']);
define('FACEBOOKAPPID', $row['facebookappid']);
define('TWITTERCONSUMERKEY', $row['twitterconsumerkey']);
define('TWITTERCONSUMERKEYSECRET', $row['twitterconsumerkeysecret']);
define('TWITTERACCESSTOKEN', $row['twitteraccesstoken']);
define('TWITTERACCESSTOKENSECRET', $row['twitteraccesstokensecret']);
define('GOOGLELOGINCLIENTID', $row['googleloginclientid']);
define('GOOGLELOGINSECRET', $row['googleloginsecret']);
define('GOOGLEICONLINK', $row['googleiconlink']);
define('GOOGLEMAILAPI', $row['googlemailapi']);
define('FACEICONLINK', $row['facebookiconlink']);
define('LINKEDINICONLINK', $row['linkediniconlink']);
define('TWITTERICONLINK', $row['twittericonlink']);
define('TWITTERAPPDISPLAY', 0);
define('FACEBOOKAPPDISPLAY', 0);
define('LOGO', $row['logo']);
define('THUMBNAIL', $row['thumbnail']);
define('DEFAULT_INDUSTRYID', 20);
define('DEFAULT_INDUSTRY', 'IT');
define('SENDMAIL', 1);



    }
} 

$conn->close();