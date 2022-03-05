<?php

namespace App\Controller\Component;

use Cake\Mailer\Email;  
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class EmailcComponent extends Component
{

 public function send_email($sendvalues) {
 
        if(empty($sendvalues['templateid'])) { return false; } else { $templateid = $sendvalues['templateid']; }
         
        $sendvalues['bcc'] = 0; 
         //get the template table in the db
        $EmailTemp = TableRegistry::get('EmailTemplates');
        $template = $EmailTemp->get($templateid);

        if (empty($template)) {
            return false;
        } 
 
        if(empty($sendvalues['to'])) { return false; } else { $to = $sendvalues['to']; }
        if(!empty($sendvalues['receiver_id'])) { $receiver_id = $sendvalues['receiver_id']; } else { $receiver_id = 0; }
        if(!empty($sendvalues['sender_id'])) { $sender_id = $sendvalues['sender_id']; } else { $sender_id = 0; }
        if(!empty($sendvalues['logsent'])) { $logsent = $sendvalues['logsent']; } else { $logsent = 0; }
        if(!empty($sendvalues['logreceived'])) { $logreceived = $sendvalues['logreceived']; } else { $logreceived = 0; }
                
        $from = DEFAULT_SITE_EMAIL;    
        if(empty($sendvalues['keys'])) { return false; } else { $values = $sendvalues['keys']; }
        if(!empty($sendvalues['subject'])) {  $subject = $sendvalues['subject']; } else {  $subject = $template->subject;  }
        if( ($template->bcc == 1) && (!empty($template->bcc_email)) ) { $sendvalues['bcc'] = 1; $bcc_email = $template->bcc_email;}
        if(!empty($template->layout_id)) { 
        
            $EmailLayout = TableRegistry::get('EmailLayouts');
            $getlayout = $EmailLayout->get($template->layout_id);
            
            if(!empty($getlayout->name)) { 
                $layout = $getlayout->name;
            } else {
                $layout = 'thisisdefault12_4'; 
            }
        
        } else {
        
            $layout = 'thisisdefault12_4'; 
        
        }

            
        $constants = $template->constants;
        
        $body = $template->body;
          
        $email_keys = explode(",", $constants);
        
//We are NOT using the standard cake 3 way here 
//the reason is we want to format our layout - and we don't want php variables in the code placed in the database
// so we replace the key array in the controller with values in the email body that is indicated with {{ }}


		foreach($email_keys as $key=>$email_const)
		{
			$email_const = '{{'.$email_const.'}}';
			$email_keys[$key] = $email_const;
		}
    
      $email_keys = array_map('trim', $email_keys);
      $description = str_replace($email_keys, $values, $body);
      
      $template = '';
      
      if (empty($template)) {
            $template = 'default';
      }
    

      $email = new Email();
                  
            
  if($sendvalues['bcc'] == 1) { 
      
        $email->from([$from => SITE])
        ->to($to)
        ->bcc($bcc_email) 
        ->emailFormat('html')
        ->template($template, $layout)
        ->subject($subject)
        ->send($description);
  
      } else {
        
        $email->from([$from => SITE])
        ->to($to)
        ->emailFormat('html')
        ->template($template, $layout)
        ->subject($subject)
        ->send($description);
        
      }
      
      
      
            $logTable = TableRegistry::get('EmailLogs');
            $log = $logTable->newEntity();
            $log->receiver = $receiver_id;
            $log->receiver_email = $to;
            $log->sender_email = DEFAULT_SITE_EMAIL;
            $log->sender = $sender_id;
            $log->email_template_id = $sendvalues['templateid'];
            $log->subject = $subject;
            $log->message = $description; 
            $log->created = date("Y-m-d");
            $log->modified = date("Y-m-d");
                 
            $logTable->save($log);
            
           if($logreceived == 'received') {
           
              $receiveTable = TableRegistry::get('Messengers');
              $receive = $receiveTable->newEntity();
              $receive->user_id = $receiver_id;
              $receive->direction = 'received';
              $receive->sender_id = $sender_id;
              $receive->sender_email = DEFAULT_SITE_EMAIL;
              $receive->receiver_id = $receiver_id;
              $receive->receiver_email = $to;
              $receive->title = $subject;
              $receive->message = $description; 
              $receive->created = date("Y-m-d");
              $receive->modified = date("Y-m-d");
                   
              $receiveTable->save($receive);
            
            }
            
            if($logsent == 'sent') {
            
                $sentTable = TableRegistry::get('Messengers');
                $sent = $sentTable->newEntity();
                $sent->user_id = $sender_id;
                $sent->direction = 'sent';
                $sent->sender_id = $sender_id;
                $sent->sender_email = DEFAULT_SITE_EMAIL;
                $sent->receiver_id = $receiver_id;
                $sent->receiver_email = $to;
                $sent->title = $subject;
                $sent->message = $description; 
                $sent->created = date("Y-m-d");
                $sent->modified = date("Y-m-d");
                     
                $sentTable->save($sent);
           }
        
        return true;
    }
}
?>