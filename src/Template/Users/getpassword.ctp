<div class="col-md-5 col-md-offset-3">
  <div class="contentbox">
    <h3 class="white">Reset your password</h3>                      
    <?= $this->Form->create() ?>
    <p>Please provide your email </p>
    <?= $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Email"]) ?>
    <?= $this->Form->button(__('Send'), ['class'=>'btn btn-primary btn-login float-right']) ?>
    <BR><BR><BR>

<?php if(GOOGLECAPTCHA == 1) { ?> 
<div class="row">
				<div class="col-sm-12">
        <div class="g-recaptcha" data-sitekey="<?php echo GOOGLESITEKEY; ?>"></div>
				</div>
</div>
<?PHP } ?>
      <?= $this->Form->end() ?> 
  </div>
</div>