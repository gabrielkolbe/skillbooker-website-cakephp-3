<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'edit_comment_action', $comment->id]]); ?>
<span class="large-legend">Edit Comment</span> 
<?php echo $this->Form->textarea('comment', ['class'=>'form-control  validate[blockscript] ckeditor', 'label' => false, 'value' => $comment->comment]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right submit']) ?>
<?= $this->Form->end() ?>
<BR><BR>