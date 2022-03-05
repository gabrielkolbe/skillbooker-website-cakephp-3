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

<div class="row contentbox">

  <div class="col-md-6 col-xs-12">
  <BR>
  <H1>Timesheet</h1><BR>
  
  <h2><?= h($timesheet->name) ?></h2> <BR>
    <h3><strong>Employer:</strong> <?= h($employer) ?></h3>
    <h3><strong>Agent:</strong> <?= h($agent) ?></h3>
    <h3><strong>Employee:</strong> <?= h($employee) ?></h3> 
    <h3><strong>Status:</strong> APPROVED</h3><BR><BR>
    
  </div>
  
  <div class="col-md-6 col-xs-12">
  <BR><BR>
     <?php echo $calendar; ?>
     <BR>
       <?= h($employee) ?> has worked in <?php echo date('F',strtotime($timesheet->currentmonth)); ?> on the following dates: <?php echo $timesheet->days; ?>
       <BR>
       <BR>
  </div> 
  
 </div>
 </div> 

    