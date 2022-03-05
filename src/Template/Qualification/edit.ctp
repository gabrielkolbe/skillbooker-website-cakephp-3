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

<?php echo $this->Form->create($qualification,  ['url' => ['plugin' => null,'controller' => 'qualification','action' => 'editaction']]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  <H1>Edit Qualification</H1>

<?php echo $this->Form->hidden("id",['value'=>$qualification['id']]); ?>

<?php if($qualification->displayme == 1){$checked = 'checked';} else {$checked = '';} ?>
<?php echo $this->Form->input('displayme', ['type'=>'checkbox', 'value'=> 1, 'class'=>'displayme', 'label'=>' Display on Online CV/Resume', $checked]); ?>

<?php echo $this->Form->text("name",['class'=>'form-control', "placeholder"=>"Name of Qualification", 'required' => true]);  ?>
<?php echo $this->Form->text("type_of_qualification",['class'=>'form-control', "placeholder"=>"Your position in the company", 'required' => true]);  ?>
<?php echo $this->Form->text("institution",['class'=>'form-control', "placeholder"=>"Name of the company", 'required' => true]);  ?>
<?php echo $this->Form->text("field",['class'=>'form-control', "placeholder"=>"Location", 'required' => true]);  ?>
<?php echo $this->Form->input('country_id', ['options' => $countries, 'class'=>'form-control', 'label' => false, 'placeholder'=>'Which Country?', 'required' => true]); ?>
<?php echo $this->Form->input('from_date', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'From Date (yyyy-mm-dd)', 'required' => true]);	?>
<?php echo $this->Form->input('to_date', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'To Date (yyyy-mm-dd)', 'required' => true]);	?>	
    
		<?php echo $this->Form->textarea("description",['class'=>'form-control ckeditor', "placeholder"=>"Describe Your Qualification", 'required' => true]);  ?>

<?php echo $this->Form->end();?>