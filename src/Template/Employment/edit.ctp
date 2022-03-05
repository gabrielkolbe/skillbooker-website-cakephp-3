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
<?php echo $this->Form->create($employment,  ['url' => ['plugin' => null,'controller' => 'employment','action' => 'editaction']]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  <H1>Edit Employment</H1>

<?php echo $this->Form->hidden("id",['value'=>$employment['id']]); ?>

<?php if($employment->displayme == 1){$checked = 'checked';} else {$checked = '';} ?>
<?php echo $this->Form->input('displayme', ['type'=>'checkbox', 'value'=> 1, 'class'=>'displayme', 'label'=>' Display on Online CV/Resume', $checked]); ?>
<?php echo $this->Form->text("position",['class'=>'form-control', "placeholder"=>"Your position in the company", 'required' => true]);  ?>
<?php echo $this->Form->text("company",['class'=>'form-control', "placeholder"=>"Name of the company", 'required' => true]);  ?>
<?php echo $this->Form->text("job_location",['class'=>'form-control', "placeholder"=>"Location", 'required' => true]);  ?>
<?php echo $this->Form->input('from_date', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'From Date (yyyy-mm-dd)', 'required' => true]);	?>
<?php echo $this->Form->input('to_date', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'To Date (yyyy-mm-dd)', 'required' => true]);	?>	
<?php echo $this->Form->textarea("description",['class'=>'form-control ckeditor', "placeholder"=>"Describe Your employment", 'required' => true]);  ?>

<?php echo $this->Form->end();?>