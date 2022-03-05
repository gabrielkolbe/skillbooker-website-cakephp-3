<H1>Sending a message to <?php echo $name; ?></H1>
<p>The following message will be send to '<?php echo $name; ?>'s' email address</p>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'messenger','action' => 'sendemailaction']]); ?>
<?php  echo $this->Form->hidden('receiver_slug', ['value'=>$slug]); ?>
<?php echo $this->Form->text("title",['class'=>'form-control', "placeholder"=>"Email Title"]);  ?>
<?php echo $this->Form->textarea("message",['class'=>'form-control ckeditor', "placeholder"=>"Email Content"]);  ?>

<p><strong><u>Please note:</u></strong><BR> Always be polite not abuse will be tollerated, if you have a problem contact support</p>
<?= $this->Form->button(__('Send Messsage'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']) ?>
<?php  echo $this->Form->end(); ?>
<BR><BR>