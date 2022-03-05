<style>
.opacity{
 opacity: 0.5;
}

.hideme {
  display: none;
}
</style> 
<div class="row"> 
  <div class="col-sm-12">
   
    <div class="contentbox">          
        <h1><img src="/img/HR.png" height="15" width="15"> <?= $project->name ?></h1>
  			<strong>Started:</strong> <?php echo $project->date_human; ?>     
          <?php if ($project->cost1 == $project->paid1 ) { ?><span onClick="sendajax('/projects/addextrahoursModal/<?=$project->slug?>')" class="btn btn-primary btn-xs orange float-right">Add more hours</span><?php } ?>
          <span onClick="sendajax('/projects/addnotes_modal/<?=$project->slug?>')" class="btn btn-primary btn-xs orange float-right">Add Notes</span>
          <BR> 
        <div class="row one stage1">
            <div class="col-sm-10">
              <h2 class="bluetxt">Description</h2><BR>
                <strong><span class="orangetxt" style="font-size:26px;"><?php echo $project->complete1; ?>%</span> complete</strong><BR><BR>
              <?php echo $project->stage1 ?><BR><BR>
              <strong><?php echo $project->numberhours; ?> hours</strong> at a cost of <?php echo $project->awardedamount; ?> per/hour = <strong><span class="orangetxt"><?php echo $project->denomination; ?><?php echo $project->cost1; ?></span></strong><BR>
            </div>
            <div class="col-sm-2">
            <?php 
            if($project->complete1 == 100) { 
            if ($project->cost1 <> $project->paid1 ) {
                         
                echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'payments','action' => 'project']]); 
                echo $this->Form->hidden('slug', ['value'=>$project->slug]); 
                echo $this->Form->hidden('stage', ['value'=>1]);
                echo '<span class="float-right"><img src="../../img/paypal2.jpg" width="100px" style="margin-right: 20px; margin-top:20px;"></span>';  
                $button = 'Send >>  '.$project->denomination.$project->cost1;
                echo $this->Form->button($button, ['id'=>'submit', 'class'=>'btn btn-primary float-right']); 
         
             } else { ?>
                      <img src="/img/paid.png" height="60" width="60" class="float-right">
              <?php } } else { ?>
            <span onClick="sendajax('/projects/setprogressmodal/<?php echo $project->slug; ?>')" class="btn btn-warning btn-xs float-right">Set Progress</span>
           <?php } ?>
            </div>
        </div>
        
 
      
      </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <?php 
    foreach($notes as $note) {?>   
        <div class="row one">
            <div class="col-sm-12">
              <h2 class="bluetxt">More notes - <?php echo $note->created; ?></h2>
                  <?php
                      echo $this->Form->postLink(__('Delete'), ['plugin' => null, 'controller' => 'projects', 'action' => 'deletenote',$note->id], ['confirm' => __('Are you sure you want to delete this note {0}?  ', $note->id), 'class' => 'btn btn-danger btn-xs float-right']); 
                  ?>
                      <span onClick="sendajax('/projects/editnotes_modal/<?php echo $note->id; ?>')" class="btn btn-primary btn-xs float-right">Edit note</span>      			     
                <?php echo $note->notes; ?><BR>
            </div>
        </div>
    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <?php 
    foreach($extrahours as $extrahour) {?>   
        <div class="row one">
            <div class="col-sm-11">
              <h2 class="bluetxt">Extra work hours - <?php echo $extrahour->created; ?></h2>
              <strong><span class="orangetxt" style="font-size:26px;"><?php echo $extrahour->completed; ?>%</span> completed</strong> <BR>       			     
                <?php echo $extrahour->notes; ?><BR>
                <strong><?php echo $extrahour->hours; ?> extra hours</strong> at a cost of <?php echo $project->awardedamount; ?> per/hour = <strong><span class="orangetxt"><?php echo $extrahour->denomination; ?><?php echo $extrahour->cost; ?></span></strong><BR>
            </div>
            <div class="col-sm-1">
                <?php if ($extrahour->completed <> 100 ) { ?><span onClick="sendajax('/projects/extrahourprogress_modal/<?php echo $extrahour->slug.'$'.$extrahour->id; ?>')" class="btn btn-warning btn-xs float-right">Set Progress</span>
                <?php } else { 
                if ($extrahour->cost <> $extrahour->paid ) {
                                           
                      echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'payments','action' => 'extrawork']]); 
                      echo $this->Form->hidden('slug', ['value'=> $extrahour->slug.'$'.$extrahour->id]); 
                      echo '<span class="float-right"><img src="../../img/paypal2.jpg" width="100px" style="margin-right: 20px; margin-top:20px;"></span>';  
                      $button = 'Send >>  '.$extrahour->denomination.$extrahour->cost;
                      echo $this->Form->button($button, ['id'=>'submit', 'class'=>'btn btn-primary float-right']); 
                               
                   } else { ?>
                      <img src="/img/paid.png" height="60" width="60" class="float-right">
                   <?php }
                } 
                ?> 
            </div>
        </div>
    <?php } ?>
  </div>
</div>