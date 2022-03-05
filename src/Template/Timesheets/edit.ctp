 <?php $this->Html->css('phpcalendar', ['block'=>true]); ?>
<?php $this->Html->script('jquery-ui', ['block'=>true]); ?>


<script>
//    var checkbox = $(this).find('td.calender_simple_select input:checkbox');
 // $('table tbody tr td').on('click', function(e){
 //$(document).on('click','.phpcalendar',function(e){
 
$(function(){
$(document).on('click','table tbody tr td',function(e){
    var checkbox = $(this).find('input:checkbox');
    if (!$(e.target).is(':checkbox')) {
        checkbox.attr('checked', !checkbox.is(':checked'));
    }
    $(this).css('background-color', checkbox.is(':checked')?'#ffa500':'#F0F0F0');
});
});
 
</script> 



<div class="row">
	<div class="col-md-12">
    <div class="contentbox">
    <?= $this->Form->create($timesheet) ?>

    <fieldset>
    <div class="row">
    <div class="col-md-12">
        <span class="large-legend">Create Timesheet</span>
        <BR><BR>
   </div>

	<div class="col-md-12">
    <?php echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']); ?>
    <BR>
  </div>

    <div class="col-md-12 col-xs-12">
<?php  echo $this->Form->input('employer', ['options' => $employers, 'class'=>'form-control', 'label' => 'Employer']); ?>
  </div> 
   
  <div class="col-md-12 col-xs-12">
<?php  echo $this->Form->input('agent', ['options' => $agents, 'class'=>'form-control', 'label' => 'Agent']); ?>
  </div>        
 
  
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
  </div> 
  

  <div class="col-md-12 col-xs-12" id="calendarhere"> 
    <BR><BR> 
  <h2>Edit days here, in order to select a different month and year start a new timesheet</h2>
  <BR>
     <?php echo $calendar; ?>
  </div> 
  
</div>
    </fieldset>

    <BR><BR>
</div>
</div>
</div>