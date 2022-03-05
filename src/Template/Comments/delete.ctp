<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'comments','action' => 'deleteaction']]); ?>
<input type="hidden" id="comment_id" name="comment_id" value="<?=$comment_id?>">
  <H1>ARE YOU SURE?</H1>
  <BR>
<?= $this->Form->button(__('DELETE'), ['class'=>'btn btn-danger']) ?>               
<?php echo $this->Form->end();?>