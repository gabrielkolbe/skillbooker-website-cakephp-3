<?php $this->Html->css('bootstrap-datepicker.min'); ?>
<?php $this->Html->script('bootstrap-datepicker.min'); ?>
<script>
$(function() {
  $("input#publishdate").datepicker({
        format: 'yyyy-mm-dd'
    });
});
</script>

<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'publication','action' => 'addaction']]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  <H1>Add A Publication</H1>
             
<?php echo $this->Form->input('displayme', ['type'=>'checkbox', 'class'=>'displayme', 'label'=>' Display on Online CV/Resume']); ?>

<?php echo $this->Form->text("name",['class'=>'form-control', "placeholder"=>"Name of Publication", 'required' => true]);  ?>
<?php echo $this->Form->text("url",['class'=>'form-control', "placeholder"=>"URL link if needed e.g. http://.."]);  ?>
<?php echo $this->Form->text("publisher",['class'=>'form-control', "placeholder"=>"Publisher", 'required' => true]);  ?>
<?php echo $this->Form->input('publishdate', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'Published Date (yyyy-mm-dd)', 'required' => true]);	?>
<?php echo $this->Form->textarea("description",['class'=>'form-control ckeditor', "placeholder"=>"Describe Your Publication", 'required' => true]);  ?>

<?php echo $this->Form->end();?>