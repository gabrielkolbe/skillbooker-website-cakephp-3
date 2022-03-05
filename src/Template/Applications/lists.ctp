<div class="row"> 
	<div class="col-md-12">
  <?php if( !empty($jobid) ) { echo $this->Html->link(__('All Applications'), ['plugin' => null, 'controller' => 'applications', 'action' => 'applications'], ['class' => 'btn btn-primary float-right']); } ?>
  <legend><?= __('Candidate Applications') ?></legend>
    
<?php if(empty($applications)){ ?> 	
  <div class="contentbox">
     <p> Sorry, you have no current Applications </p>	
  </div>
<?php } else { ?> 
<?php foreach($applications as $application){ ?>   
  	<div class="contentbox">
      <?= $this->Form->postLink(__('Delete'), ['plugin'=>'Jobboard', 'controller'=>'jobs', 'action' => 'deleteapplication', $application->Application['id']], ['confirm' => __('Are you sure you want to delete application:   {0}?', $application->title), 'class' => 'btn btn-danger float-right']) ?>	
      <h4><?php echo $this->Html->link($application->Users['name'],['plugin'=>null, 'controller'=>'online', 'action'=>'cv', $application->Users['slug']]); ?> <a href="mailto:<?php echo $application->Users['email']; ?>?Subject=Your%20Application" target="_top" class="btn btn-primary float-right">Send Mail</a></h4>
      <strong>Applied:</strong> <?=$application->Application['created']?> for <?php echo $this->Html->link($application->title,['plugin'=>'Jobboard', 'controller'=>'jobs', 'action'=>'view', $application->id]); ?>
    </div>
    <BR>
<?php } } ?>
</div>
</div>
