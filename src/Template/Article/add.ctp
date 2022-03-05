<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'article','action' => 'addaction']]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  <H1>Add An Article</H1>
             
<?php echo $this->Form->input('displayme', ['type'=>'checkbox', 'class'=>'displayme', 'label'=>' Display on Online CV/Resume']); ?>

<?php echo $this->Form->text("name",['class'=>'form-control', "placeholder"=>"Name of Article", 'required' => true]);  ?>
<?php echo $this->Form->text("source",['class'=>'form-control', "placeholder"=>"Source of Article (if you have not written it yourself)", 'required' => true]);  ?>
<?php echo $this->Form->input('tags', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'Comma seperated list of keywords (will help with SEO)', 'required' => true]);	?>
<?php echo $this->Form->textarea("short",['class'=>'form-control ckeditor', "placeholder"=>"Short Content", 'required' => true]);  ?>
<?php echo $this->Form->textarea("content",['class'=>'form-control ckeditor', "placeholder"=>"Content", 'required' => true]);  ?>

<?php echo $this->Form->end();?>