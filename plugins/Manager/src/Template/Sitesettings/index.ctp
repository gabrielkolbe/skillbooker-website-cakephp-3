<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<script>
$(document).ready(function() {
   
    $('#countryid').change(function(){     
    $.ajax({
         type : "POST",
                url  : ('/users/getstate/') + $("#countryid option:selected").val(),
                success : function(opt){
                        document.getElementById('stateid').innerHTML = opt;   
                    }
            })
            });
                          
}); 
</script> 

<div class="row">
	<div class="col-md-12">

         <legend><?= __('Manage SiteSettings') ?></legend>  
    <?= $this->Form->create($sitesetting, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>

        <?php
            echo $this->Form->input('site', ['class'=>'form-control', 'label' => 'Site Name', 'placeholder'=>'Site Name']);
            echo $this->Form->input('domain', ['class'=>'form-control', 'label' => 'http://???', 'placeholder'=>'Domain Name']);
            echo $this->Form->input('rooturl', ['class'=>'form-control', 'label' => 'http or https', 'placeholder'=>'http...']);
$options = array(
    'true' => 'true',
    'false' => 'false'
);          echo $this->Form->input('mode', ['options' => $options, 'empty' => true, 'label' => 'Developement Mode (false / true)', 'class'=>'form-control']);

$paypal = array(
    'true' => 'true',
    'false' => 'false'
);          echo $this->Form->input('paypalsandbox', ['options' => $paypal, 'empty' => true, 'label' => 'Paypal Sandbox (false / true)', 'class'=>'form-control']);
            
            
            echo $this->Form->input('default_email', ['class'=>'form-control', 'label' => 'Default Site Email', 'placeholder'=>'Default site email']);
            echo $this->Form->input('seodescription', ['class'=>'form-control', 'label' => 'Default SEO Description', 'placeholder'=>'SEO Short Description']);
            echo $this->Form->input('description', ['class'=>'form-control ckeditor', 'label' => 'Full Description - the who, the why - display on static page']);
            echo $this->Form->input('keywords', ['class'=>'form-control', 'label' => 'Default SEO Comma seperated keywords', 'placeholder'=>'Comma seperated keywords']);
            echo $this->Form->input('default_pagetitle', ['class'=>'form-control', 'label' => 'Default Page Title', 'placeholder'=>'Default Page Title']);
            echo $this->Form->input('homeurl', ['class'=>'form-control', 'label' => 'Home URL', 'placeholder'=>'Home URL']);
            echo $this->Form->input('redirecturl', ['class'=>'form-control', 'label' => 'Redirect after login URL', 'placeholder'=>'Redirect after login URL']);
            echo $this->Form->input('address', ['class'=>'form-control ckeditor', 'label'=>'Address as it will apprear on the site']);
            echo '<BR>';

            echo $this->Form->input('country_id', ['id' => 'countryid', 'options' => $countries, 'class'=>'form-control', 'label' => false, 'empty' => 'Select Default Country']);
            echo $this->Form->input('state_id', ['id' => 'stateid', 'options' => $states, 'class'=>'form-control', 'label' => false, 'empty' => 'Select Default State']);
            
            echo '<BR><h3>Mail Setup</h3>';
            echo $this->Form->input('mailhost', ['class'=>'form-control', 'label' =>'Email Set up: Host name']);
            echo $this->Form->input('mailuser', ['class'=>'form-control', 'label' =>'Email Set up: User name']);
            echo $this->Form->input('mailpassword', ['class'=>'form-control', 'label' =>'Email Set up: Password']);
            echo $this->Form->input('mailport', ['class'=>'form-control', 'label' =>'Email Set up: Port']);
            
$mails = array(
    'Mail' => 'Mail',
    'Smtp' => 'Smtp'
);          echo $this->Form->input('mailtype', ['options' => $mails, 'empty' => true, 'label' =>'Email Set up: Type: Mail / Smtp', 'class'=>'form-control']);
           
            echo '<BR><h3>Social Media Buttons Links</h3>';
            echo $this->Form->input('googleiconlink', ['class'=>'form-control', 'label' => 'Google Icon Link']);
            echo $this->Form->input('facebookiconlink', ['class'=>'form-control', 'label' =>'Facebook Icon Link']);
            echo $this->Form->input('linkediniconlink', ['class'=>'form-control', 'label' =>'LinkedIn Icon Link']);
            echo $this->Form->input('twittericonlink', ['class'=>'form-control', 'label' =>'Twitter Icon Link']); 

            echo '<BR><h3>Google Mail API</h3>';
            echo $this->Form->input('googlemailapi', ['class'=>'form-control', 'label' =>'Google Mail API']); 

            echo '<BR><h3>Google reCaptcha</h3>';
            echo $this->Form->input('googlesitekey', ['class'=>'form-control', 'label' =>'Google reCaptcha Site Key']);
            echo $this->Form->input('googlesecretkey', ['class'=>'form-control', 'label' =>'Google reCaptcha Secret Key']);
            echo $this->Form->input('googlecaptcha', ['class'=>'form-control', 'label' =>'Display Google reCaptcha?']);
            echo '<BR><h3>Google Login</h3>';
            echo $this->Form->input('googleloginclientid', ['class'=>'form-control', 'label' =>'Google Login Client ID']); 
            echo $this->Form->input('googleloginsecret', ['class'=>'form-control', 'label' =>'Google Login Secret Key']);  

            
            echo '<BR><h3>Posting To Twitter</h3>';
            echo '
            STEPS: <BR>
            Sign into Twitter and go to https://apps.twitter.com/<BR>
First step is to create an APP <BR>
Click on the APP created and select Keys and Access Tokens <BR>
Insert your Consumer key, Consumer Secret, Access Token, Access Token Secret in to the fields provided <BR>
<BR>
';
            echo $this->Form->input('twitterconsumerkey', ['class'=>'form-control', 'label' =>'TWEET to TWITTER: setup: Consumer Key']);
            echo $this->Form->input('twitterconsumerkeysecret', ['class'=>'form-control', 'label' =>'TWEET to TWITTER: setup: Consumer Key Secret']);
            echo $this->Form->input('twitteraccesstoken', ['class'=>'form-control', 'label' =>'TWEET to TWITTER: setup: Access Token']);
            echo $this->Form->input('twitteraccesstokensecret', ['class'=>'form-control', 'label' =>'TWEET to TWITTER: setup: Access Token Secret']);
            echo '<BR><h3>Display Twitter Feed on Site</h3>';
            
            
echo 'STEPS: <BR>
To add an embedded timeline to your website:<BR>
Sign in to Twitter.<BR>
Go to your settings and select Widgets. <BR>
Click Create new.  <BR>
Choose the type of embedded timeline you d like and start to configure it:<BR>
For User Timeline, enter the username of the user whose Tweets you want to display. <BR>
For Favorites, enter the username of the user whose favorites you want to display. <BR>
For List, select a public list that you own and/or subscribe to in the drop-down menu.<BR>
For Search, enter your search query (for advanced searches, use Twitter s search operators). <BR>
Make sure to select Safe mode if you want to exclude sensitive content, profanity, etc.<BR>
Customize the design by specifying the height, theme (light or dark), and link color to match your website. You can also configure your embedded timeline to auto-expand Tweets containing media.<BR>
Click Create widget and then copy and paste the code into the HTML of your site. You’re done! <BR>';

            echo $this->Form->input('twitterfeed', ['class'=>'form-control', 'label' => 'Twitter Feed - Shows latest Twitter Activity']);
  
            echo '<BR><h3>Facebook</h3>';
            
                        echo '
            STEPS:<BR> 1. Go to https://developers.facebook.com/  <BR>
2. Select "Apps | Create a New App" from the top menu   <BR>
3. Enter a Display Name and select a category(I chose "Apps for Pages" but I dont know if it matters).  <BR>
4. Click create App and get click through the captch form. <BR>
5. Click settings on the left side menu   <BR>
6. Click "+ Add Platform" and select "Website"   <BR>
7. For the "Site URL", enter the of for the folder containing the example <BR>
8. Get the App ID and App Secret at the top portion of the page and enter it into the example program.<BR>
';

            echo $this->Form->input('facebookappid', ['class'=>'form-control', 'label' =>'Facebook App ID']);         
            echo $this->Form->input('facebookappsecret', ['class'=>'form-control', 'label' =>'Facebook App Secret']);

                        
            echo '<BR><h3>Favicons, Logos and Images</h3>';
            echo $this->Form->input('thumbnail', ['class'=>'form-control', 'label' =>'Thumbnail size pixels - get resized on upload']);            
            echo $this->Form->input('favicon', ['class'=>'form-control', 'label' => 'Favicon.ico', 'type' => 'file']);
         
            if(!empty($sitesetting['favicon'])){  ?>
            <?php
            echo $this->Html->link('DELETE FAVICON', ['action' => 'deletefavicon', $sitesetting['id']], ['class' => 'btn btn-danger'] );   
            //echo $this->Form->postLink(__('D'), ['action' => 'deletefavicon', $sitesetting['id']], ['confirm' => __('Are you sure you want to delete this favicon?', $sitesetting['id']), 'class' => 'btn btn-danger btn-xs']); 
            ?>            
             Current Favicon: <img src="../../favicon.ico">
             <BR> <BR>
             
           <?php }
            echo '<strong>Site Logo</strong><BR>';
            echo $this->Form->input('logo', ['class'=>'form-control', 'label' => false, 'type' => 'file']);
             if(!empty($sitesetting['logo'])){
              echo $this->Html->link('DELETE LOGO', ['action' => 'deletelogo', $sitesetting['id']], ['class' => 'btn btn-danger'] );
              echo '<BR><BR>';  
            //echo $this->Form->postLink(__('D'), ['action' => 'deletelogo', $sitesetting['id']], ['confirm' => __('Are you sure you want to delete this logo?', $sitesetting['id']), 'class' => 'btn btn-danger btn-xs']);  
           
                echo $this->Html->image($sitesetting['logo'], [
                'class' => 'memberimage']
                );
            }
         
          ?>  
            
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    
</div>
</div>