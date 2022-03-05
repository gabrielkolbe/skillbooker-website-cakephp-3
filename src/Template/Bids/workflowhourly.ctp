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
        <h1 class="blueheader"><img src="/img/HR.png" height="15" width="15"> <?= $project->name ?></h1>
                <?= $this->Html->link(__('>> back to Bids'), ['controller' => 'bids', 'action' => 'index'], ['class' => 'btn btn-primary btn-xs float-right']) ?>
        <span onClick="sendajax('/messenger/contactuser/<?php echo $owner->slug; ?>')" class="btn btn-primary btn-xs float-right">Contact <?php echo $owner->name; ?></span>
        <strong>Started:</strong> <?php echo $project->date_human; ?>     
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
                         
         
             } else { ?>
                      <img src="/img/paid.png" height="60" width="60" class="float-right">
              <?php } } else { ?>

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
                <?php echo $note->notes; ?><BR>
            </div>
        </div>
    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <?php foreach($extrahours as $extrahour) {?>   
        <div class="row one">
            <div class="col-sm-11">
              <h2 class="bluetxt">Extra hours</h2><BR>
              <strong><span class="orangetxt" style="font-size:26px;"><?php echo $extrahour->completed; ?>%</span> completed</strong> <BR>       			     
                <?php echo $extrahour->notes; ?><BR>
                <strong><?php echo $extrahour->hours; ?> extra hours</strong> at a cost of <?php echo $project->awardedamount; ?> per/hour = <strong><span class="orangetxt"><?php echo $extrahour->denomination; ?><?php echo $extrahour->cost; ?></span></strong><BR>
            </div>
            <div class="col-sm-1">
                <?php if ($extrahour->completed <> 100 ) { ?>
                <?php } else { 
                if ($extrahour->cost <> $extrahour->paid ) {

                               
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

