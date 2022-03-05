<script>
$(function(){
$('table tbody tr td').on('click', function(e){
    var checkbox = $(this).find('input:checkbox');
    if (!$(e.target).is(':checkbox')) {
        checkbox.attr('checked', !checkbox.is(':checked'));
    }
    $(this).css('background-color', checkbox.is(':checked')?'#ffa500':'#F0F0F0');
});
});
 
</script> 
<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'availability','action' => 'editaction',$month]]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  <H1>Edit Availability</H1>
  <p>Select days you are not available</p>
<?php echo $calendar; ?>

<?php echo $this->Form->end();?>