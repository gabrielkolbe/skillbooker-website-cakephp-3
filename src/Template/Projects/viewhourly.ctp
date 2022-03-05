<h1 class="blueheader"><img src="/img/HR.png" height="15" width="15"> <?= $project->name ?> <span class="float-right">Budged <?php echo $project->denomination ?><?php echo $project->amount ?> / Hour</span></h1>
  
  <?= $this->Html->link('Full View', ['plugin' => null, 'controller' => 'projects', 'action' => 'fullview', $project->slug], ['class' => 'btn btn-primary btn-xs float-right']) ?>
  
  <?php $now = time(); $sevendays = strtotime($project->created . ' +7 day'); ?> 
  <?php 
  if ($sevendays > $now)  {
  if (!empty($this->request->session()->read('Auth.User.id'))) {
  if( $this->request->session()->read('Auth.User.id') == $project->user_id ) {} else { 
    
    if(in_array($project->id, $mybids)) { ?>
         <span class="btn btn-success btn-xs float-right">Bid placed</span>
     <?php } else { ?>
         <span onClick="sendajax('/projects/placebidmodal/<?php echo $project->slug ?>')" class="btn btn-warning btn-xs float-right">Place a Bid</span>
      <?php
      }
      
    } } else { ?>
    <span onClick="sendajax('/users/loginmodal/')" class="btn btn-primary btn-xs float-right">Login to make a bid</span>
  <?php } } ?>
          
        <?php 
        if ($sevendays > $now)  { ?><h3 class="greenbox">OPEN</h3> <?php } else { ?>
        <h3 class="greybox">CLOSED</h3>
        <?php } ?>
        
        <?php if($project->bids > 0 ) { ?> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;  <strong>Current bids</strong> <?php echo $project->bids; ?> bids  <?php } ?>
        <BR>
        <div class="description"><strong>Summary</strong><BR><?php echo $project->short_description ?></div>
        <div class="row one">
            <div class="col-sm-12">
             <h2 class="bluetxt">Description</h2>
              <?php echo $project->stage1 ?>
            </div>
        </div>
        <strong>Skills Required</strong><BR> <?php echo $project->skills ?>  