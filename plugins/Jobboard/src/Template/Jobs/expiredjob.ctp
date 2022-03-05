<div class="row">
  <div class="col-sm-12 content">   
    <div class="contentbox">
    <h3 style="color:red">This job has EXPIRED</h3> 
        
        <h2><?= $this->Html->link($job->title, ['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'view', $job->id], ['class' => '1']) ?></h2>
  			<strong>Type:</strong> <?php echo $job->display_jobtype; ?><BR>
        <strong>Location:</strong> <?php echo $job->city; ?> <?php echo $job->display_state; ?><BR>
        <strong>Rate:</strong> <?php echo $job->display_salary; ?><BR>
        <strong>Start Date:</strong> <?php echo $job->display_date; ?><BR>
        <BR>
        <?php echo $job->description; ?>

        <BR><BR>
              
        </div>

      
      	</div>
    </div>
</div>
      