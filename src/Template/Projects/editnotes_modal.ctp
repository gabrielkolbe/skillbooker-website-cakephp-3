<H1>Edit note</H1>
<p>Notes clarify things</p>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'projects','action' => 'editnotes_action']]); ?>
<?= $this->Form->hidden('id', ['value'=>$note->id]); ?>
<?php echo $this->Form->textarea("notes",['class'=>'form-control ckeditor', "value"=>$note->notes, 'required' => true]);  ?>
<?= $this->Form->button(__('Submit'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']) ?>
<?php  echo $this->Form->end(); ?>
<BR><BR>