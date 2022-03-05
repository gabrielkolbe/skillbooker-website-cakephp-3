<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'edit_answer_action', $answer->id]]); ?>
<span class="large-legend">Edit Answer</span> 
<?php echo $this->Form->textarea('content', ['class'=>'form-control  validate[blockscript] ckeditor', 'label' => false, 'value' => $answer->content]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right submit']) ?>
<?= $this->Form->end() ?>
<BR><BR>