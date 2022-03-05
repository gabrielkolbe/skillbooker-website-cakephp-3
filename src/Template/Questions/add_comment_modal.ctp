<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'add_comment_action', $question->id]]); ?>
<span class="large-legend">Add Comment</span><BR>
<p>Please NOTE: Comments are for clarification only. <BR> 
The post author will always be notified. To notify a commenter, mention them like: @username.
</p>
<?php echo $this->Form->textarea('comment', ['class'=>'form-control  validate[blockscript] ckeditor', 'label' => false, 'placeholder' => 'Use comments to replay to other comments. When adding new information, edit your post instead']); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right submit']) ?>
<?= $this->Form->end() ?>
<BR><BR>