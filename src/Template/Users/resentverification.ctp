<div class="col-md-6 col-md-offset-3">
<div class="contentbox">
 
    <h2>Resent email verification</h2>
      
      <?= $this->Form->create() ?>
      <?= $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Email"]) ?>
      <?= $this->Form->button(__('Send'), ['class'=>'btn btn-primary btn-login float-right'] ) ?>
      <?= $this->Form->end() ?> 
 <BR><BR> 
 
 <?php if(GOOGLECAPTCHA == 1) { ?> 
<div class="row">
				<div class="col-sm-12">
        <div class="g-recaptcha" data-sitekey="<?php echo GOOGLESITEKEY; ?>"></div>
				</div>
</div>
<?PHP } ?>
  
</div>
</div>                             