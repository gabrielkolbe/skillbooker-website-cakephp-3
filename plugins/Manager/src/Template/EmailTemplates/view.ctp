<div class="row">
	<div class="col-md-12">
<?php if($emailTemplate->isdefault == 1) { } else {  echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $emailTemplate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $emailTemplate->id), 'class' => 'btn btn-danger float-right marginleft10'] );  } ?> 
<?php echo $this->Html->link('Edit Email Template', ['controller' => 'email_templates', 'action' => 'edit', $emailTemplate->id], ['class' => 'btn btn-warning float-right'] );  ?>

<BR><BR>
   <h3><?= h($emailTemplate->subject) ?></h3>  
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($emailTemplate->body)); ?>
    </div>
    <BR><BR>
      <div class="row">
        <h4><?= __('Description and Purpose') ?></h4>
        <?= $this->Text->autoParagraph(h($emailTemplate->description)); ?>
    </div>
    
</div>
