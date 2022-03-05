    <?php $now = time(); $sevendays = strtotime($project->created . ' +7 day'); $created = strtotime($project->created); $countdown =  $sevendays - $now; ?>
<script>

  var upgradeTime = <?php echo $countdown; ?>;
  
  var seconds = upgradeTime;
  function timer() {
    var days        = Math.floor(seconds/24/60/60);
    var hoursLeft   = Math.floor((seconds) - (days*86400));
    var hours       = Math.floor(hoursLeft/3600);
    var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
    var minutes     = Math.floor(minutesLeft/60);
    var remainingSeconds = seconds % 60;
    function pad(n) {
      return (n < 10 ? "0" + n : n);
    }
    document.getElementById('countdown').innerHTML = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
    if (seconds == 0) {
      clearInterval(countdownTimer);
      document.getElementById('countdown').innerHTML = "Completed";
    } else {
      seconds--;
    }
  }
  var countdownTimer = setInterval('timer()', 1000); 
  
  </script>
  
  <div class="row">
  <div class="col-sm-12">   
    <div class="contentbox">       
        <h1 class="blueheader"><img src="/img/HR.png" height="15" width="15"> <?= $project->name ?> <span class="float-right">Budged <?php echo $project->denomination ?><?php echo $project->amount ?> / Hour</span></h1>

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
  if ($sevendays > $now)  { ?>
  <span id="countdown" class="timer bigred"></span>
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
    </div>
  </div>
</div>