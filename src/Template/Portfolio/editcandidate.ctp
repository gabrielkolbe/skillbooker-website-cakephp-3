<script>
$('#editcandidate').click(function(){
    $('.required .form-control').each(function() {
        if($(this).val() == '') {
           $(this).css('background-color' , '#ffd27f !important');
        }
    });
});
</script>
<?php echo $this->Form->create($candidate,  ['url' => ['plugin' => null, 'controller' => 'portfolio', 'action' => 'editcandidateaction'], 'type' => 'file']); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right', 'id' => 'editcandidate']) ?>   
<h1>Edit Candidate Details</h1> 	

  <div class="row"> 
	<div class="col-md-6">
  <?php
            echo '<strong>Available from</strong><BR>';
            echo $this->Form->input('available_from', ['class'=>'form-control', 'label'=>false]);
         
          if($candidate['displayme'] == 1){$checked = 'checked';} else {$checked = '';} ?>
 <?php echo $this->Form->input('displayme', ['type'=>'checkbox', 'value'=> '1', 'class'=>'displayme', 'label'=>' Display on Online CV/Resume', $checked]); ?>

        <?php 
            echo $this->Form->input('ideal_position', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Ideal Position', 'required' => true]);
            echo $this->Form->input('ideal_location', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Ideal Locations (comma separate)', 'required' => true]);
            echo $this->Form->input('ideal_salary', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Ideal Salary example: 3000 per month', 'required' => true]);
            echo $this->Form->input('jobtype_id', ['options' => $jobtypes, 'label' => false, 'empty' => 'What Job Type Do You Prefer >>', 'class'=>'form-control', 'required' => true]); 
         ?>

  </div>
	<div class="col-md-6">
  
        <?php
            echo $this->Form->input('contactmethod_id', ['options' => $contactmethods, 'label' => false, 'empty' => 'Select Best Contact Method >>', 'class'=>'form-control', 'required' => true]);
            echo $this->Form->input('googleplus', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Link to Googleplus']);
            echo $this->Form->input('linkedin', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Link to LinkedIn Profile']);
            echo $this->Form->input('facebook', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Link to Facebook Page']);
            echo $this->Form->input('twitter', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Link to Twitter Profile']);
            echo $this->Form->input('skype', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Skype Handle']);
            echo $this->Form->input('website', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Link to own Website/Profile (http://....']);

         ?>
  </div>
    <?= $this->Form->end() ?>

</div>