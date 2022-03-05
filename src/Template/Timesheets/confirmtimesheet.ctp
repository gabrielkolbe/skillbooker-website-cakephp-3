<script>
$(function(){
$(document).on('click','#insertcalendar table tbody tr td',function(e){
    var checkbox = $(this).find('input:checkbox');
    if (!$(e.target).is(':checkbox')) {
        checkbox.attr('checked', !checkbox.is(':checked'));
    }
    $(this).css('background-color', checkbox.is(':checked')?'#ffa500':'#F0F0F0');
});
});
 
</script> 
<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'timesheets','action' => 'confirmaction',$slug]]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  <H1>Confirm timesheet days</H1>
  <p>Select days on the calendar for the timesheet</p>
<?php echo $calendar; ?>

<?php echo $this->Form->end();?>