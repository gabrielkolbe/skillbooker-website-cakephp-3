<style>
.opacity{
 opacity: 0.5;
}

.hideme {
  display: none;
}
</style>
<?php 
if($project->stageinterval == '1') { 
$stage1 = 1;
$stage2 = 0;
$stage3 = 0;
$stage4 = 0;
} if($project->stageinterval == '2') { 
$stage1 = 1;
$stage2 = 1;
$stage3 = 0;
$stage4 = 0;
} if($project->stageinterval == '3') { 
$stage1 = 1;
$stage2 = 1;
$stage3 = 1;
$stage4 = 0;
 } if($project->stageinterval == '4') { 
$stage1 = 1;
$stage2 = 1;
$stage3 = 1;
$stage4 = 1;
 } ?> 
 
<div class="row">
  <div class="col-sm-12">   
    <div class="contentbox">          
        <h1 class="blueheader"><img src="/img/FP.png" height="15" width="15"> <?= $project->name ?></h1>
        <?= $this->Html->link(__('>> back to Bids'), ['controller' => 'bids', 'action' => 'index'], ['class' => 'btn btn-primary btn-xs float-right']) ?>
        <span onClick="sendajax('/messenger/contactuser/<?php echo $owner->slug; ?>')" class="btn btn-primary btn-xs float-right">Contact <?php echo $owner->name; ?></span>
  			<strong>Started:</strong> <?php echo $project->date_human; ?><BR>      
        <span class="btn btn-primary btn-xs" id="all">All</span> <span class="btn btn-primary btn-xs" id="stage1">Stage 1</span> <span class="btn btn-primary btn-xs" id="stage2">Stage 2</span> <span class="btn btn-primary btn-xs" id="stage3">Stage 3</span> <span class="btn btn-primary btn-xs" id="stage4">Stage 4</span>

      <?php if($stage1 == '1') { ?>
        
        
        <div class="row one stage1 <?php if ($project->cost1 == $project->paid1 ) { echo 'hideme'; } ?>">
            <div class="col-sm-10">
              <h2 class="bluetxt">Stage One</h2><BR>
                <strong><span class="orangetxt" style="font-size:26px;"><?php echo $project->complete1; ?>%</span> complete</strong><BR><BR>
              <?php echo $project->stage1 ?><BR><BR>
              <?php if ($project->cost1 <> $project->paid1 ) { ?><strong>On completion please pay</strong> <span class="bluetxt"><?php echo $project->denomination; echo $project->cost1; ?></span>
              <?php } else { ?>
                <strong>Payment has been made</strong>
              <?php } ?>
            </div>
            <div class="col-sm-2">
            <?php 
            if($project->complete1 == 100) { 
            if ($project->cost1 <> $project->paid1 ) {

         
             } } else { ?>
           <?php } ?>
            </div>
        </div>
        
         <?php } ?>
        <?php if($stage2 == '1') { ?>
         
        <div class="row two stage2 <?php if ($project->cost2 == $project->paid2 ) { echo 'hideme'; } ?>">
            <div class="col-sm-10">
              <h2 class="bluetxt">Stage Two</h2><BR>
              <strong><span class="orangetxt" style="font-size:26px;"><?php echo $project->complete2; ?>%</span> complete</strong><BR><BR>
              <?php echo $project->stage2 ?><BR><BR>
              <?php if ($project->cost2 <> $project->paid2 ) { ?><strong>On completion please pay</strong> <span class="bluetxt"><?php echo $project->denomination; echo $project->cost2; ?></span>
              <?php } else { ?>
              <strong>Payment has been made</strong>
              <?php } ?>
            </div>
            <div class="col-sm-2">
              <?php 
              if($project->cost1 == $project->paid1) {  
               if( $project->complete2 == 100 ) { 
               if ($project->cost2 <> $project->paid2 ) { 



               } } else { ?>

              <?php } } ?>
            </div>
        </div>
        
        <?php } ?>
        <?php if($stage3 == '1') { ?>
        
        <div class="row one stage3 <?php if ($project->cost3 == $project->paid3 ) { echo 'hideme'; } ?>">
            <div class="col-sm-10">
              <h2 class="bluetxt">Stage Three</h2><BR>
              <strong><span class="orangetxt" style="font-size:26px;"><?php echo $project->complete2; ?>%</span> complete</strong><BR><BR>
              <?php echo $project->stage3 ?><BR><BR>
              <?php if ($project->cost3 <> $project->paid3 ) { ?><strong>On completion please pay</strong> <span class="bluetxt"><?php echo $project->denomination; echo $project->cost3; ?></span>
              <?php } else { ?>
              <strong>Payment has been made</strong>
              <?php } ?>
            </div>
            <div class="col-sm-2">
              <?php 
              if($project->cost2 == $project->paid2) {  
               if( $project->complete3 == 100 ) { 
               if ($project->cost3 <> $project->paid3 ) { 


               } } else { ?>

              <?php } } ?>
            </div>
        </div>
 
         <?php } ?>
        <?php if($stage4 == '1') { ?>       
        
        <div class="row two stage4 <?php if ($project->cost4 == $project->paid4 ) { echo 'hideme'; } ?>">
            <div class="col-sm-10">
              <h2 class="bluetxt">Stage Four</h2><BR>
              <strong><span class="orangetxt" style="font-size:26px;"><?php echo $project->complete4; ?>%</span> complete</strong><BR><BR>
              <?php echo $project->stage4 ?><BR><BR>
              <?php if ($project->cost4 <> $project->paid4 ) { ?><strong>On completion please pay</strong> <span class="bluetxt"><?php echo $project->denomination; echo $project->cost4; ?></span>
              <?php } else { ?>
              <strong>Payment has been made</strong>
              <?php } ?>
            </div>
            <div class="col-sm-2">
              <?php 
              if($project->cost3 == $project->paid3) {  
               if( $project->complete4 == 100 ) { 
               if ($project->cost4 <> $project->paid4 ) { 


               } } else { ?>

              <?php } } ?>
            </div>
        </div>    

      <?php } ?>                
                 
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

<script type="text/javascript">

$(document).ready(function() {

    $("#all").click(function() {
        $(".stage1").show();
        $(".stage2").show();
        $(".stage3").show();
        $(".stage4").show();
    });

    $("#stage1").click(function() {
        $(".stage1").show();
        $(".stage2").hide();
        $(".stage3").hide();
        $(".stage4").hide();
    });
    
    $("#stage2").click(function() {
        $(".stage1").hide();
        $(".stage2").show();
        $(".stage3").hide();
        $(".stage4").hide();
    });
  
      $("#stage3").click(function() {
        $(".stage1").hide();
        $(".stage2").hide();
        $(".stage3").show();
        $(".stage4").hide();
    });
    
    $("#stage4").click(function() {
        $(".stage1").hide();
        $(".stage2").hide();
        $(".stage3").hide();
        $(".stage4").show();
    });
});
</script>
<?php 
if($project->stageinterval == '1') { ?>
<script type="text/javascript">
      $( "#stage1" ).hide();
      $( "#stage2" ).hide();
      $( "#stage3" ).hide();
      $( "#stage4" ).hide();
      $( "#all" ).hide();
</script>
<?php } if($project->stageinterval == '2') { ?>
<script type="text/javascript">
      $( "#stage1" ).show();
      $( "#stage2" ).show();
      $( "#stage3" ).hide();
      $( "#stage4" ).hide();
      $( "#all" ).hide();
</script>
<?php } if($project->stageinterval == '3') { ?>
<script type="text/javascript">
      $( "#stage1" ).show();
      $( "#stage2" ).show();
      $( "#stage3" ).show();
      $( "#stage4" ).hide();
      $( "#all" ).hide();
</script>
<?php } if($project->stageinterval == '4') { ?>
<script type="text/javascript">
      $( "#stage1" ).show();
      $( "#stage2" ).show();
      $( "#stage3" ).show();
      $( "#stage4" ).show();
      $( "#all" ).show();
</script> 
<?php } ?> 
  