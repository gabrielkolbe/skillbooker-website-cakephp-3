<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'comments','action' => 'commentaction']]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
<input type="hidden" id="tutorial_id" name="tutorial_id" value="<?=$tutorial_id?>">
<H1>Leave A Comment</H1>
               
<?php echo $this->Form->textarea("comment",['class'=>'form-control ckeditor', "placeholder"=>"Reply to comment"]);  ?>

<?php echo $this->Form->end();?>