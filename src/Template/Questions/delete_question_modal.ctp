
<h1>Want to delete this question?</h1>
<p>We do not recommend deleting questions with answers because doing so deprives future readers of this knowledge. Since this question has answers on it we would appreciate if you either</p>
<BR>
<h2>Edit it instead</h2>
<p>Do you want to delete it because it is sensitive information? </p>
<p>Hide proprietary code, websites, people, places etc to removing identifying detail</p>
<span onClick="sendajax('/questions/edit_question_modal/<?php echo $question->slug; ?>')" class="btn btn-primary">Edit Question</span>
<BR><BR>
<h2>I don't want my name disassociate with it</h2>
<p>Disassociate the question from your account - in this way others can still benefit from your knowledge</p>
<p>Note:this can not be reversed</p>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'disassociate_question_action', $question->slug]]); ?>
<?= $this->Form->button(__('Disassociate from Question'), ['class'=>'btn btn-primary submit']) ?><BR><BR>
<?= $this->Form->end() ?>
<BR>
<h2>If nothing else will do..you can delete the question</h2>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'delete_question_action', $question->slug]]); ?>
<?= $this->Form->button(__('Delete Question'), ['class'=>'btn btn-primary submit']) ?><BR><BR>
<span class="fakelink floatright" onClick="closemodal()">Cancel</span>
<?= $this->Form->end() ?>
<BR><BR>