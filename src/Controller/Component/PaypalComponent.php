<?php

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class PaypalComponent extends Component
{

     public function activate($settings)
    {
                  
      // payments through then this setting needs changing to `false`.
      $enableSandbox = $settings['sandbox'];
      
      $paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
      
      // Check if paypal request or response
      if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {
      
          // Grab the post data so that we can set up the query string for PayPal.
          // Ideally we'd use a whitelist here to check nothing is being injected into
          // our post data.
          $data = [];
          foreach ($_POST as $key => $value) {
              $data[$key] = stripslashes($value);
          }
          
          $this->log('data' , 'debug');
          $this->log($data , 'debug');
      
          // Set the PayPal account.
          $data['business'] = $enableSandbox ? 'payment-facilitator@skillbooker.com' : $settings['business'];
          
          $data = $settings;
      
          // Set the PayPal return addresses.
          $data['return'] = stripslashes($settings['return_url']);
          $data['cancel_return'] = stripslashes($settings['cancel_url']);
          $data['notify_url'] = stripslashes($settings['notify_url']);
          
          // Build the query string from the data.
          $queryString = http_build_query($data);
          
          $this->log('queryString' , 'debug');
          $this->log($queryString , 'debug');
          // Redirect to paypal IPN
          header('location:' . $paypalUrl . '?' . $queryString);
          exit();
      
       } 
    }
    
    
  public function response($settings) { 
        
      $enableSandbox = $settings['sandbox'];
      
      $paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
          
          $this->log('response posts' , 'debug');
          $this->log($_POST , 'debug');   
            
          // Assign posted variables to local data array.
          $data = [
              'item_name' => $_POST['item_name'],
              'item_number' => $_POST['item_number'],
              'payment_status' => $_POST['payment_status'],
              'payment_amount' => $_POST['mc_gross'],
              'payment_currency' => $_POST['mc_currency'],
              'txn_id' => $_POST['txn_id'],
              'receiver_email' => $_POST['receiver_email'],
              'payer_email' => $_POST['payer_email'],
              'custom' => $_POST['custom'],
          ];
          
          
          // We need to verify the transaction comes from PayPal and check we've not
          // already processed the transaction before adding the payment to our
          // database.
          if ( ( $this->verifyTransaction($_POST, $paypalUrl) == true ) && ( $this->checkTxnid($data['txn_id']) == true ) ) {
              return $data;
          }
      }
    
      
      function verifyTransaction($data, $paypalUrl) {
      
          $req = 'cmd=_notify-validate';
          foreach ($data as $key => $value) {
              $value = urlencode(stripslashes($value));
              $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
              $req .= "&$key=$value";
          }
      
          $ch = curl_init($paypalUrl);
          curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
          curl_setopt($ch, CURLOPT_SSLVERSION, 6);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
          curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
          $res = curl_exec($ch);
      
          if (!$res) {
              $errno = curl_errno($ch);
              $errstr = curl_error($ch);
              curl_close($ch);
              throw new Exception("cURL error: [$errno] $errstr");
          }
      
          $info = curl_getinfo($ch);
      
          // Check the http response
          $httpCode = $info['http_code'];
          if ($httpCode != 200) {
              throw new Exception("PayPal responded with http code $httpCode");
          }
      
          curl_close($ch);
           
          if($res === 'VERIFIED') { return true; } else { return false; }
      }
      
      
      function checkTxnid($txnid) {
      
          $txnid = $this->mres($txnid); // a bit of peach of mind
          
          $payments = TableRegistry::get('payments');

          $payments->find('all', ['conditions' => ['txnid' => $txnid]]);
          $countresult = count($payments);
          
          if (empty($countresult)) {
            return false;
          } else {
            return true;
          }
      
      }
      
        function mres($value)
      {
          $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
          $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
      
          return str_replace($search, $replace, $value);
      }
      

}
?>