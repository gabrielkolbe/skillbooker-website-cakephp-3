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
  <p class="two">This is an <strong>example</strong> of what the <strong>EMPLOYER (APPROVER)</strong> will see</p>  
<H1>Timesheet</h1>
<h2><?= h($timesheet->name) ?></h2>
    <BR>
<h3><strong>Employer:</strong> <?= h($employer) ?></h3>
<h3><strong>Agent:</strong> <?= h($agent) ?></h3>
<h3><strong>Employee:</strong> <?= h($employee) ?></h3>
<BR>
  <p class="two">
  <i>Please approve the timesheet by clicking on the 'APPROVE' button and uploading your signature, this timesheet will be sent to the agent</i></p> 
 <BR>
  <div class="col-md-6 col-xs-12">
  <h2>Please, confirmed the days that has been worked</h2>
  <BR>
     <?php echo $calendar; ?>
  </div> 
  
  <div class="col-md-6 col-xs-12"> 

  <?php // echo $this->Form->input('signature', ['class'=>'form-control', 'label' => 'Please upload your signature', 'type' => 'file']); ?>
  
  <p class="two">
  <i>By clicking here you confirm everything you submit is true </i><?php echo $this->Form->checkbox('confirm');  ?></p>
  <BR>

  <p class="two"><span class="btn btn-primary">Approve</span> Approve button for EMPLOYER </p>
  </div> 

    