<script>
$('#editdetails').click(function(){
    $('.required .form-control').each(function() {
        if($(this).val() == '') {
           $(this).css('background-color' , '#ffd27f !important');
        }
    });
});
</script>
<?php echo $this->Form->create($user,  ['url' => ['plugin' => null, 'controller' => 'users', 'action' => 'editaction'], 'type' => 'file']); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right', 'id' => 'editdetails']) ?>   
<h1>My Details</h1> 	

  <div class="row"> 
	<div class="col-md-6">

        <?php 
            echo $this->Form->input('firstname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'First Name', 'required' => true]);
            echo $this->Form->input('lastname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Last Name', 'required' => true]);
            echo $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'** Email', 'required' => true]);
            echo $this->Form->input('avatar', ['class'=>'form-control', 'label' => 'Profile Avatar', 'type' => 'file']);
         ?>
         <small>Avatar will be cropped square. (GIF, JPG or PNG; limit 10MB)</small>
  </div>
	<div class="col-md-6"> 
  
        <?php
            echo $this->Form->input('telephone', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Telephone Number']);
            echo $this->Form->input('mobile', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Mobile Number']);
            echo $this->Form->input('communicationsetting_id', ['id' => 'communicationsetting-id', 'options' => $communicationsettings, 'class'=>'form-control', 'label' => false, 'empty' => 'Select Communication', 'required' => true]);
            echo $this->Form->input('country_id', ['id' => 'country-id', 'options' => $countries, 'class'=>'form-control', 'label' => false, 'empty' => 'Select Country', 'required' => true]);
            echo $this->Form->input('industry_id', ['id' => 'industry_id', 'options' => $industries, 'class'=>'form-control', 'label' => false, 'empty' => 'Select Industry', 'required' => true]);
         ?>
  </div>
    <?= $this->Form->end() ?>

</div>				