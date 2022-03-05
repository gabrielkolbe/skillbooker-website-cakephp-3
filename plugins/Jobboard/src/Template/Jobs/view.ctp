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

h6 a {
 color:#000;
}
h6 a:hover {
 color:#000;
}
</style>
  <input value="activate selector" id="activate_selectator4" type="button">
  
<?php echo $this->element('Jobboard.jobs/searchbar');  ?>
<BR>
<div class="row">
<?php if(!empty($suggested)){ ?>
<div class="col-sm-2">
         <div class="tabs">
				<ul>
				<?php 
						foreach($suggested as $data){
				?>
					<li>
							<h6><?= $this->Html->link($data->Jobs['title'], ['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'view', $data->Jobs['slug']]) ?></h6>
              <?php echo $data->Jobs['display_jobtype']; ?><BR>
							<?php echo $data->Jobs['city']; ?>							
					</li>
				<?php	} ?>
				</ul>
     </div>       	
  </div>
<?php	} ?>

  <div class="col-sm-10 content">   

    <div class="contentbox">   
        <div class='float-right'>
        <?php if (!empty($this->request->session()->read('Auth.User.id'))) { ?>
               <span onClick="sendajax('/applications/applymodal/<?php echo $job->id; ?>')" class="btn btn-primary">Apply For this Job</span> 
        <?php } else {  ?>
                    <span onClick="sendajax('/users/loginmodal/')" class="btn btn-primary">Login to Apply</span>
          <?php } ?>
    		</div>

        
        <h2><?= $this->Html->link($job->title, ['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'view', $job->slug], ['class' => '1']) ?></h2>
  			<strong>Type:</strong> <?php echo $job->display_jobtype; ?><BR>
        <strong>Location:</strong> <?php echo $job->city; ?> <?php echo $job->display_state; ?><BR>
        <strong>Rate:</strong> <?php echo $job->display_salary; ?><BR>
        <strong>Start Date:</strong> <?php echo $job->display_date; ?><BR>
        <BR>
        <?php echo $job->description; ?>

        <BR><BR>
              
     <?php if (!empty($jobskills)) {  ?>
        <div class="skills">
        <?php 
          foreach($jobskills as $skill){
            echo $this->Html->link($skill->skill_name,['plugin'=>'jobboard', 'controller'=>'Jobs', 'action'=>'search', $skill->slug], ['class'=>'btn btn-inverse']); 
          }
        ?>
        </div>
      <?php  }  ?>
      
      	</div>
    </div>
</div>
      