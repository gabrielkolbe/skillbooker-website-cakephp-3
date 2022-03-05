<h1>Sign in with Facebook</h1>
<?php

if(isset($authUrl)) {
echo $this->Html->image('facebook.jpg', [
                'class' => ' facebook',
                'alt' => 'facebook',
                'url' => $authUrl
                ]);
                
} 

echo $output;

?>