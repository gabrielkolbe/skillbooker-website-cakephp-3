
<div class="row"> 
	<div class="col-md-12">
  <legend>My Applications</legend>
<?php if(empty($applications)){ ?> 	
  <div class="contentbox">
     <p> Sorry, you have no current Job Applications </p>	
  </div>
<?php } else { ?> 
<?php foreach($applications as $application){ ?>   
  	<div class="contentbox">
      <?= $this->Form->postLink(__('Delete'), ['plugin'=>null, 'controller'=>'applications', 'action' => 'deleteapplication', $application->Application['id']], ['confirm' => __('Are you sure you want to delete application:   {0}?', $application->title), 'class' => 'btn btn-danger float-right']) ?>	
      <h4><?php echo $this->Html->link($application->title,['plugin'=>'Jobboard', 'controller'=>'jobs', 'action'=>'view', $application->id]); ?></h4>
      <strong>Applied:</strong> <?=$application->Application['created']?> for <?=$application->display_jobtype?> in <?=$application->city?> ( <?=$application->display_salary?> )
    </div>
    <BR>
<?php } } ?>
</div>
</div>
