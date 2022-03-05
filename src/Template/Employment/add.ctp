<?php $this->Html->css('bootstrap-datepicker.min'); ?>
<?php $this->Html->script('bootstrap-datepicker.min'); ?>
<script>
$(function() {
  $("input#from-date").datepicker({
        format: 'yyyy-mm-dd'
    });
  $("input#to-date").datepicker({
        format: 'yyyy-mm-dd'
    });
});
</script>


<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'employment','action' => 'addaction']]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right', 'id' => 'submitbtn']) ?>
  <H1>Add A Employment</H1>
               
<?php echo $this->Form->input('displayme', ['type'=>'checkbox', 'class'=>'displayme', 'label'=>' Display on Online CV/Resume']); ?>

<?php echo $this->Form->text("position",['class'=>'form-control', 'placeholder'=>'Your position in the company', 'required' => true]);  ?>
<?php echo $this->Form->text("company",['class'=>'form-control', 'placeholder'=>'Name of the company', 'required' => true]);  ?>
<?php echo $this->Form->text("job_location",['class'=>'form-control', 'placeholder'=>'Location', 'required' => true]);  ?>
<?php echo $this->Form->input('from_date', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'From Date (yyyy-mm-dd)', 'required' => true]);	?>
<?php echo $this->Form->input('to_date', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'To Date (yyyy-mm-dd)', 'required' => true]);	?>	
<?php echo $this->Form->textarea("description",['class'=>'form-control ckeditor', "placeholder"=>"Describe Your employment", 'required' => true]);  ?>

<?php echo $this->Form->end();?>