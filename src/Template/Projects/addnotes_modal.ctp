<H1>Add notes</H1>
<p>Notes can be added to explain things better to freelancers working on your projects</p>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'projects','action' => 'addnotes_action']]); ?>
<?= $this->Form->hidden('slug', ['value'=>$slug]); ?>
<?php echo $this->Form->textarea("notes",['class'=>'form-control ckeditor', "placeholder"=>"Add notes", 'required' => true]);  ?>
<?= $this->Form->button(__('Submit'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']) ?>
<?php  echo $this->Form->end(); ?>
<BR><BR>