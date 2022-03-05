<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<script>
$(document).ready(function () {


     $('.q_tip1').qtip({
     content: {
              text: 'Describe the <strong>scope, timescale, technologies involved, the desired outcome</strong>
            After each <strong>stage</strong> the freelancer complete, the project owner will <strong>pay</strong> once confirmed that he/she is satisfied.
            Select how many <strong>stages of development and payment</strong> you need for this project.'
          },
          style: {
              classes: 'qtip-bootstrap'
          },
    
        show: {
            effect: function() {
                $(this).slideDown();
            }
        },
        hide: {
            effect: function() {
                $(this).slideUp();
            }
        }
     });

    

});
</script>
 
<script>
$(document).ready(function() {

var text_max = 200;
$('#counter').html(text_max + ' characters remaining');

$('.cke_editable').keyup(function() {
    var text_length = $('.cke_editable').val().length;
    var text_remaining = text_max - text_length;

    $('#counter').html('<strong>' + text_remaining + '</strong>');
});

});

$('#numberhours').keyup(function() {
var hours = parseInt(document.getElementById("numberhours").value);
    if( (hours < 0.01) || (hours > 60) ){
      $('#checkit').html('Number has to be bigger than 0 and smaller than 60');
    } 
});

</script>

<div class="row">
	<div class="col-md-12">
  <div class="contentbox">
    <?= $this->Form->create($project, ['id' => 'addproject']) ?>
    <?php  echo $this->Form->hidden('projecttype', ['value'=>2]); ?>
    <?php  echo $this->Form->hidden('stageinterval', ['value'=>1]); ?>

        <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <fieldset>

<span onClick="sendajax('/projects/inserttemplatemodal/2')" class="btn btn-primary btn-xs">Populate your project with a template</span>
<?= $this->Html->link(__('Add Static Project'), ['plougin' => null, 'controller' => 'projects', 'action' => 'add'], ['class' => 'btn btn-primary btn-xs']) ?>

<BR><BR>
          <span class="large-legend">Project Name</span> 
 <?php                   
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'required' => true]);
  ?>
  
             <BR><span class="q_tip1"></span><span class="large-legend">Tell us what you need</span> 
           <BR>The first 200 characters will be used in the summary ( used: <span id="counter"> </span> )
<?php       
            echo '<div id="stageone"><BR><strong>Stage One</strong>';    
            echo $this->Form->input('stage1', ['class'=>'validate[blockscript] ckeditor form-control', 'label' => false, 'required' => true]);
            echo '</div>';
?>
<BR>
<span class="large-legend">Number of hours</span> 
<p>Estimated number of hours to start this project,(not more than 60) you can add more later</strong><BR><span id="checkit"> </span></p>
<?php
            echo $this->Form->input('numberhours', ['class'=>'form-control',  'type' => 'text', 'label' => false, 'style' => 'width:110px;', 'placeholder'=>'Numbers', 'required' => true]);
?>
   <BR>
  <span class="large-legend">Payment to freelancer</span>
  <p>On completion pay the freelancer, currency and budget for hourly rate (this might change)</p>
<div style="display: inline-block;">
    <?php echo $this->Form->input('currency_id', ['class'=>'form-control', 'label' => false, 'style' => 'width:100px;', 'empty'=>'Select Paid Currency >>', 'required' => true]); ?>
</div>
<div style="display: inline-block;">
    <?php echo $this->Form->input('amount', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'style' => 'width:110px;', 'placeholder'=>'Numbers', 'required' => true]); ?>
</div>

         </fieldset>
      <BR>       
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right', 'id' => 'submitbtn']) ?>
    <?= $this->Form->end() ?>
        <BR><BR>

</div>
</div>
</div>   