<H1>Job Application</H1>
<h4><?php echo $job->title; ?></h4>
<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'applications','action' => 'applyaction']]); ?>
<?php echo $this->Form->hidden("id",['value'=>$job->id]); ?>
<?= $this->Form->button(__('Apply'), ['class'=>'btn btn-primary float-right']) ?> 
<p>Before you apply make sure <?= $this->Html->link(__('your online CV'), ['plugin' => null, 'controller' => 'portfolio', 'action' => 'index']) ?> is updated as this is what the employer will see.</p>
<?php  echo $this->Form->end(); ?>