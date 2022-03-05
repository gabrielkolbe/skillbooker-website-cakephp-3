
<div class="col-md-5 col-md-offset-3">
<div class="contentbox">
<h3>Register your details</h3> 
<p>Please verify your email address by the link that will be send to you</p>                               
<?= $this->Form->create($user) ?>
<?php
            echo $this->Form->input('firstname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'First Name']);
            echo $this->Form->input('lastname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Last Name']);
            echo $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Email Address']); 
            echo  $this->Form->button(__('Register'), ['class'=>'btn btn-primary btn-login float-right']); 
?>				

<BR>
 
<?php if(GOOGLECAPTCHA == 1) { ?> 
<div class="row">
				<div class="col-sm-12">
        <div class="g-recaptcha" data-sitekey="<?php echo GOOGLESITEKEY; ?>"></div>
				</div>
</div>
<?PHP } ?>
<?= $this->Form->end() ?>
<div class="row">
<BR>
<div class="col-sm-12">
<p>Have an account?     
<?php echo $this->Html->link( __('Login',true),['plugin'=>null, 'controller'=>'users','action' => 'login'] ); ?><BR>
By logging in or registering, you agree to our  <?= $this->Html->link('Terms of Service', 'terms-and-conditions') ?> and <?= $this->Html->link('Privacy Policy', 'privacy-policy') ?><BR>
<?php echo $this->Html->link( __('Forgot Password ?',true),['plugin'=>null, 'controller'=>'users','action' => 'getpassword'], ['class'=>'pull-left dark-grey'] ); ?><BR>
<?php echo $this->Html->link( __('Resend Email Verification Link',true),['plugin'=>null, 'controller'=>'users','action' => 'resentverification'], ['class'=>'pull-left dark-grey'] ); ?></p><BR>
</div>
</div>

			</div>
                
</div>