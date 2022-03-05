<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>

<script type="text/javascript">

  function showfield(name){
    if(name=='1') {
      $( "#stageone" ).show(); 
      $( "#stagetwo" ).hide();
      $( "#stagethree" ).hide();
      $( "#stagefour" ).hide();
    }
    if(name=='2') {
      $( "#stageone" ).show();
      $( "#stagetwo" ).show();     
      $( "#stagethree" ).hide();
      $( "#stagefour" ).hide();
    }
    if(name=='3') {
      $( "#stageone" ).show();
      $( "#stagetwo" ).show();
      $( "#stagethree" ).show();     
      $( "#stagefour" ).hide();
    }
    if(name=='4') {
      $( "#stageone" ).show();
      $( "#stagetwo" ).show();
      $( "#stagethree" ).show();
      $( "#stagefour" ).show(); 
    } 
  };

</script>
    
<script>


$(document).ready(function() {
var text_max = 140;
$('#counter').html(text_max + ' characters remaining');

$('#short_description').keyup(function() {
    var text_length = $('#short_description').val().length;
    var text_remaining = text_max - text_length;

    $('#counter').html('<strong>' + text_remaining + '</strong> characters remaining');
});

});

</script>

<style>
.error {
color:red;
}
</style>

<div class="row">
	<div class="col-md-12">
  <div class="contentbox">
    <?= $this->Form->create($project, ['id' => 'addproject']) ?>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <fieldset>
    
              <span class="large-legend">Project Name</span> 
 <?php                   
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'required' => true]);
  ?>
  <BR>
  <span class="large-legend">Stages of Development</span> 
<p>Every project has 1 - 4 stages of development.</p>
<?php
            $intervalsoptions = array();
            $intervalsoptions[1] = 'One';
            $intervalsoptions[2] = 'Two';
            $intervalsoptions[3] = 'Three'; 
            $intervalsoptions[4] = 'Four';  
                                                                       
            echo $this->Form->input('stageinterval', ['options' => $intervalsoptions, 'class'=>'form-control', 'label' => false, 'style' => 'width:100px;', 'default' => '1',  'onchange' => 'showfield(this.options[this.selectedIndex].value)']); 
?>  
            <BR><span class="q_tip1"></span><span class="large-legend">Tell us what you need</span> 
           <BR>The first 200 characters will be used in the summary ( used: <span id="counter"> </span> )
<?php       
            echo '<div id="stageone"><BR><strong>Stage One</strong>';    
            echo $this->Form->input('stage1', ['class'=>'validate[blockscript] ckeditor form-control', 'label' => false, 'required' => true]);
            echo '</div>';
            echo '<div id="stagetwo"><BR><strong>Stage Two</strong>';
            echo $this->Form->input('stage2', ['class'=>'validate[blockscript] ckeditor form-control', 'label' => false]);
            echo '</div>';
            echo '<div id="stagethree"><BR><strong>Stage Three</strong>';
            echo $this->Form->input('stage3', ['class'=>'validate[blockscript] ckeditor form-control', 'label' => false]);
            echo '</div>';
            echo '<div id="stagefour"><BR><strong>Stage Four</strong>';
            echo $this->Form->input('stage4', ['class'=>'validate[blockscript] ckeditor form-control', 'label' => false]);
 ?>
    </div> 
   <BR>
  <span class="large-legend">Payment to freelancer</span>
  <p>On completion pay the freelancer, currency and budget for project</p>
<div style="display: inline-block;">
    <?php echo $this->Form->input('currency_id', ['class'=>'form-control', 'label' => false, 'style' => 'width:100px;', 'empty'=>'Select Paid Currency >>', 'required' => true]); ?>
</div>
<div style="display: inline-block;">
    <?php echo $this->Form->input('amount', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'style' => 'width:100px;', 'placeholder'=>'Numbers only', 'required' => true]); ?>
</div>
 

  <div>

        <BR><BR>
         </fieldset>

      <BR>       
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right', 'id' => 'submitbtn']) ?>
    <?= $this->Form->end() ?>
     <BR><BR>

        <BR><BR>


</div>
</div>
</div>   
<?php 
if($project->stageinterval == '1') { ?>
<script type="text/javascript">
      $( "#stageone" ).show(); 
      $( "#stagetwo" ).hide();
      $( "#stagethree" ).hide();
      $( "#stagefour" ).hide();
</script>
<?php } if($project->stageinterval == '2') { ?>
<script type="text/javascript">
      $( "#stageone" ).show();
      $( "#stagetwo" ).show();     
      $( "#stagethree" ).hide();
      $( "#stagefour" ).hide();
</script>
<?php } if($project->stageinterval == '3') { ?>
<script type="text/javascript">
      $( "#stageone" ).show();
      $( "#stagetwo" ).show();
      $( "#stagethree" ).show();     
      $( "#stagefour" ).hide();
</script>
<?php } if($project->stageinterval == '4') { ?>
<script type="text/javascript">
      $( "#stageone" ).show();
      $( "#stagetwo" ).show();
      $( "#stagethree" ).show();
      $( "#stagefour" ).show();
</script> 
<?php } ?>   