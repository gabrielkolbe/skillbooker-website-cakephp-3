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
  <input value="activate selector" id="activate_selectator4" type="button">
  
  <style>
.hideme {
            display: none;
        }
</style>
<?php echo $this->element('Jobboard.jobs/searchbar');  ?>
<BR>
<div class="row">
<div class="col-xs-12 col-sm-2">
         <div class="tabs">
				<ul>
				<?php 
					if(!empty($result)){
					$i = 0;
						foreach($result as $tab){
             if( $user_id  == $tab->Application['user_id'] ) { } else { 
				?>
				
					<li class="t" id="<?=$tab->slug?>">
							<h6><?php echo $tab->title; ?></h6>
              <?php echo $tab->display_jobtype; ?><BR>
							<?php echo $tab->display_salary; ?><BR>
							<?php echo $tab->city; ?>							
					</li>
				<?php	
						$i++;
            }
						}

					}
				?>
				</ul>
     </div>       	
  </div>
<div class="col-xs-12 col-sm-8 content">   
  
	<?php if(!empty($result)){  ?>
    			<p class="blueheader"><span><?php echo $i;?></span> Jobs Found</p>
    <?php
		$i=1;
		foreach($result as $job) { 
        if( $user_id  == $job->Application['user_id'] ) { } else { ?>
    
    <div class="contentbox hideme first<?=$i?>" id="section<?=$job->slug?>">
      <div class='float-right'>
      <?php if (!empty($this->request->session()->read('Auth.User.id'))) { ?>
             <span onClick="sendajax('/applications/applymodal/<?php echo $job->id; ?>')" class="btn btn-primary">Apply For this Job</span> 
      <?php } else {  ?>
                  <span onClick="sendajax('/users/loginmodal/')" class="btn btn-primary">Login to Apply</span>
        <?php } ?>
  		</div>
  
        <h1 class="bluefont"><?= $this->Html->link($job->title, ['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'view', $job->slug], ['class' => '1']) ?></h1>
  			<strong>Location:</strong> <?php echo $job->city; ?> <?php echo $job->display_state; ?><BR>
        <strong>Rate:</strong> <?php echo $tab->display_jobtype; ?> for <?php echo $job->display_salary; ?><BR>
        <strong>Start Date:</strong> <?php echo $job->display_date; ?><BR>
        <BR>
        <?php echo $job->description; ?>
        <BR>
        <strong>Listed:</strong> <?php echo $job->created; ?>
        <h4><?= $this->Html->link('View', ['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'view', $job->slug], ['class' => 'btn btn-primary float-right']) ?></h4>
        <BR><BR> 
		</div>
        
		<?php
		$i++;
        }
			}	
       }	else { ?>
      <p class="blueheader">None found, please widen your search criteria</p>
      <?php }	?>
    
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

<script type="text/javascript">

$(document).ready(function() {
    $(".first1").show();
    $("li.t").click(function() {
        
        var id = $(this).attr("id"); // li id 
        $(".hideme").hide(); // hide all other sections                       
        $("#section" + id).fadeIn("slow"); // fadeIn() wanted section

    });

});
</script>