<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'edit_question_action', $question->slug]]); ?>
<span class="large-legend">Edit title</span> 
<?php echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'value' => $question->name]); ?>
<small>150 characters maximum</small>
<BR>
<?php echo $this->Form->textarea('content', ['class'=>'form-control  validate[blockscript] ckeditor', 'label' => false, 'value' => $question->content]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right submit']) ?>
<?= $this->Form->end() ?>
<BR><BR>