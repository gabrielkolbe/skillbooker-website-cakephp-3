<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'delete_comment_action', $comment->id]]); ?>
<h1>Are you sure you want to delete this comment ?</h1> 
<BR>
<?= $this->Form->button(__('Delete Comment'), ['class'=>'btn btn-primary float-right submit']) ?><BR><BR>
<span class="fakelink floatright" onClick="closemodal()">Cancel</span>
<?= $this->Form->end() ?>
<BR><BR>