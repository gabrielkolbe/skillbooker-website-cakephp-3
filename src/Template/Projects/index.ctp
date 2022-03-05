<?php $this->Html->css('selector', ['block' => true]); ?>
<?php $this->Html->script('selector', ['block' => 'scriptBottom']); ?>
<script>
    $(function () {

			var $activate_selectator4 = $('#activate_selectator4');
			$activate_selectator4.click(function () {
				var $select4 = $('.select4');
				if ($select4.data('selectator') === undefined) {
					$select4.selectator({
						showAllOptionsOnFocus: true
					});
					$activate_selectator4.val('destroy selector');
				} else {
					$select4.selectator('destroy');
					$activate_selectator4.val('activate selector');
				}
			});
			$activate_selectator4.trigger('click');

		});     

	</script> 
<style>
#activate_selectator4 {
    display: none;
}

.multiple .selectator_input, .multiple .selectator_textlength {
    width: 100% !important;
}

.selectator { margin-top: 0px !important; }

#selectator_select4 {min-height:0px !important;}

</style>
  
  
  <div class="row">
  
  <div class="col-xs-12 col-md-9">
    <h1 class="toph1">Search Freelance Projects</h1>   
  </div>
  
  <div class="col-xs-12 col-md-3">
    <span id="countdown" class="timer bigred float-right"></span>    
  </div>    
  
  </div>
  
  <div class="row"> 
    
  <div class="col-xs-12 col-md-2">
    <div class="contentbox padding15">

      <?php echo $this->Form->create('Projects',['url'=>['plugin'=>null,'controller'=>'projects','action'=>'index']]); ?>
      <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'projectsearch']); ?>
    
      <input value="activate selector" id="activate_selectator4" type="button">
      
      <small>Search Skills</small>
        <select name="skill[]" multiple="multiple" class="select4" size="7" style="display: none;">
        <?php
        foreach($projectskillsdistinct as $key => $name){
          if(!empty($selectedprojectskills)) {
            if (array_key_exists($key, $selectedprojectskills)) { echo '<option value="'.$key.'" selected>'.$name.'</option>'; } else { echo '<option value="'.$key.'">'.$name.'</option>'; }
          } else {
            echo '<option value="'.$key.'">'.$name.'</option>';
          } 
        }
        
        ?>
     </select>
     <BR><BR>

    <input type="radio" name="projecttype_id" value="0" <?php if($projecttype == 0) { echo 'checked'; } ?> > All Projects<br> 
    <input type="radio" name="projecttype_id" value="1" <?php if($projecttype == 1) { echo 'checked'; } ?> > <img src="/img/FP.png" height="15" width="15"> Fixed Price<br>
    <input type="radio" name="projecttype_id" value="2" <?php if($projecttype == 2) { echo 'checked'; } ?> > <img src="/img/HR.png" height="15" width="15"> Hourly Rate
	
          	
    <BR>
    <?= $this->Form->submit('Update Results', ['class'=>'btn btn-primary btn-xs float-right']); ?>
    <?= $this->Form->end(); ?>
    <BR><BR>
    
    <div class="sideimg bigger768">
    <img src="/img/lego_305.jpg">
   </div> 
      
    </div>
  </div> 
  
      
	<div class="col-xs-12 col-md-8">
		<?php foreach ($projects as $project): ?>
    <div class="contentbox"> 
        <h1 class="bluefont"><?php if($project->projecttype == 1) { ?><img src="/img/FP.png" height="15" width="15"> <?php } elseif($project->projecttype == 2) { ?><img src="/img/HR.png" height="15" width="15"> <?php } else {} ?> <span onClick="sendajax('/projects/view/<?php echo $project->slug ?>')"><?php echo $project->name; ?></span></h1>
      
        <h4><?php if($project->projecttype == 1) { echo 'Estimated Budged '; echo $project->denomination; echo $project->amount; } else { echo 'Proposed Rate '; echo $project->denomination; echo $project->amount; echo '/hour'; } ?></h4>
        <?php $now = time();  $sevendays = strtotime($project->created . ' +7 day'); $created = strtotime($project->created); ?>
        <?php if($project->bids > 0 ) { ?> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;  <strong>Current bids</strong> <?php echo $project->bids; ?> bids  <?php } ?>
        
        <?php 
        if ($sevendays > $now)  { $countdown =  $sevendays - $now;  ?><h3 class="float-right greenbox">OPEN</h3> <?php } else { ?>
        <h3 class="float-right greybox">CLOSED</h3>
        <?php } ?>
        <div class="description"><?php echo $project->short_description ?></div>
        <strong>Required Skills</strong> <?php echo $project->skills ?>

  <?php 
    if ($sevendays > $now)  { 
    if (!empty($this->request->session()->read('Auth.User.id'))) {
    
    if( $this->request->session()->read('Auth.User.id') == $project->user_id ) {} else { 
    if($canbid) {   
      if(in_array($project->id, $mybids)) { ?>
         <span class="btn btn-success btn-xs float-right">Bid placed</span>
     <?php } else { ?>
         <span onClick="sendajax('/projects/placebidmodal/<?php echo $project->slug ?>')" class="btn btn-warning btn-xs float-right">Place a Bid</span>
      <?php
      }
    } else {
?>
<span onClick="sendajax('/salesoptions/subscriptionmodal')" class="btn btn-warning btn-xs float-right">Place a Bid</span>
<?php
    }
     } } else { ?>
    <span onClick="sendajax('/users/loginmodal/')" class="btn btn-primary btn-xs float-right">Login to make a bid</span>
  <?php } } ?>
  <BR><BR>
		</div>
        
<?php endforeach; ?>
</div>
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

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
        
 
</div> 

  <div class="col-md-2">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- skillbooker vertical -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-3625264154493537"
         data-ad-slot="4826439165"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    </div>
      
  </div>            