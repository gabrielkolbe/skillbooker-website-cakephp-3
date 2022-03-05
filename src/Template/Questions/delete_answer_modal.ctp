<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'delete_answer_action', $answer->id]]); ?>
<h1>Are you sure you want to delete this answer ?</h1> 
<BR>
<p>We do not recommend deleting good answers because doing so deprives future readers of this knowledge. 
<BR>
<?= $this->Form->button(__('Delete Answer'), ['class'=>'btn btn-primary float-right submit']) ?><BR><BR>
<span class="fakelink floatright" onClick="closemodal()">Cancel</span>
<?= $this->Form->end() ?>
<BR><BR>