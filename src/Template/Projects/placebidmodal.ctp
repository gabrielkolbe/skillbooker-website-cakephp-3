<H1>Please place a bid</H1>
<h4>Estimated Budged <span class="orangetxt"><?php echo $project->denomination ?><?php echo $project->amount ?> <?php if($project->projecttype == 2) { echo 'per hour'; }  ?></span></h4>

 <BR>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'projects','action' => 'placebidaction']]); ?>
Please provide a bid amount in currency: <strong><span class="orangetxt"><?php echo $project->currency_abbrev; ?> (<?php echo $project->denomination; ?>)</span></strong>
<?php if($project->projecttype == 2) { echo 'per hour'; }  ?>
<?= $this->Form->input('bidamount', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Bid Amount (numbers only, no commas, dots or spaces)"]) ?> 
<span id="checkit" class="redtxt"></span><BR>
<span class = 'btn btn-primary btn-xs'>confirm</span>
<hr>
<p><i>The following message will be send to the project owner</i></p>
<BR><p>Hi,<BR>
My maximum bid for this project '<strong><?php echo $project->name; ?></strong>' is <strong><?php echo $project->denomination; ?><span id="amounthere" class="redtxt"></span> <?php if($project->projecttype == 2) { echo 'per hour'; }  ?>. <BR>
Please consider my skill profiency and my work experience in as stated in my online CV/resume: <?php $mycv = DEFAULT_SITE_URL.'/online/cv/'.$userslug;  echo $this->Html->link($mycv, ['plugin' => null, 'controller' => 'online', 'action' => 'cv', $userslug], ['target' => '_blank']) ?> <BR>
<?php echo $this->Form->textarea("reason",['class'=>'form-control', "placeholder"=>"I can do a outstanding job on this project because...", 'required' => true]);  ?>
<BR>
<span class="redtxt" id="advice">One (1) bid per project make it COUNT !</span>
<hr>
<?= $this->Form->hidden('slug', ['value'=>$project->slug]); ?>
<input name="firstname" id="firstname" type="text" value="" />

<?= $this->Form->button(__('Submit Bid'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']) ?>
<?php  echo $this->Form->end(); ?>
<BR><BR>
<script type="text/javascript">
 $("#submit").hide();
  $("#advice").hide();
 $("#firstname").hide();
$( "#bidamount" ).change(function() {
 $("#checkit").hide();
var amount = $("#bidamount").val()

if(Math.floor(amount) == amount && $.isNumeric(amount)) {
  
      $("#advice").show();
      $("#submit").show();
      $("#amounthere").html(amount);
      
} else {
    $("#checkit").show(); 
    $("#checkit").html('Amount must be an integer, no commas, dots or spaces');
    $("#submit").hide(); 
} 

});

$('form').submit(function(){
  if($('input#firstname').val().length != 0) {
    return false;
  }
});
</script>
