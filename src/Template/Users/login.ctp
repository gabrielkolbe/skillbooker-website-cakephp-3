<div class="col-md-5 col-md-offset-3">
<div class="contentbox">
 
    <h1>Login</h1>
      
      <?= $this->Form->create() ?>
      <?= $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Email"]) ?>
      <?= $this->Form->input('password', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Password"]) ?>

<?php if(GOOGLECAPTCHA == 1) { ?> 
<div class="row">
				<div class="col-sm-12">
        <div class="g-recaptcha" data-sitekey="<?php echo GOOGLESITEKEY; ?>"></div>
				</div>
</div>
<?PHP } ?>
      <?= $this->Form->button(__('Login'), ['class'=>'btn btn-primary btn-login float-right'] ) ?>
      <?= $this->Form->end() ?> 
<div class="row">
<BR>
<div class="col-sm-12">  
<p>Don't have an account?     
<?php echo $this->Html->link( __('Register',true),['plugin'=>null, 'controller'=>'users','action' => 'register'] ); ?><BR>
By logging in, you agree to our  <?= $this->Html->link('Terms of Service', 'terms-and-conditions') ?> and <?= $this->Html->link('Privacy Policy', 'privacy-policy') ?><BR>
<?php echo $this->Html->link( __('Forgot Password ?',true),['plugin'=>null, 'controller'=>'users','action' => 'getpassword'], ['class'=>'pull-left dark-grey'] ); ?><BR>
<?php echo $this->Html->link( __('Resend Email Verification Link',true),['plugin'=>null, 'controller'=>'users','action' => 'resentverification'], ['class'=>'pull-left dark-grey'] ); ?></p><BR>
</div>
</div>

			</div>
                
</div>                            