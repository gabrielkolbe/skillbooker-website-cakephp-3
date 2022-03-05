<div class="row">
	<div class="col-md-7 col-md-offset-1"">
		<div class="contentbox">
    
    <h2>Contact Us</h2>
    <BR>
    
    <?= $this->Form->create($contactHistory) ?>
     <?= $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Your Name"]) ?>
     <?= $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Your Email"]) ?>
      <?= $this->Form->input('tel', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Your Telephone Number"]) ?>
    <?= $this->Form->input('message', ['type'=>'textarea', 'class'=>'form-control', 'label' => false, 'placeholder'=>"Your Message *"]) ?>
    
    <BR>
<?php if(GOOGLECAPTCHA == 1) { ?> 
<div class="row">
				<div class="col-sm-12">
        <div class="g-recaptcha" data-sitekey="<?php echo GOOGLESITEKEY; ?>"></div>
				</div>
</div>
<?PHP } ?>
                    
                    <BR>
    <?= $this->Form->button(__('Send'), ['class'=>'btn btn-primary btn-login float-right']) ?>
    <?= $this->Form->end() ?>
   <BR><BR> 
		</div>
	</div>
  <div class="col-md-4">
		<div class="contentbox">
		<?php echo $this->Html->image('contactus.jpg',['alt'=>'Contact us here?', 'style'=> 'width:100%; height:auto;']); ?>
		</div>
	</div>
  
</div>




