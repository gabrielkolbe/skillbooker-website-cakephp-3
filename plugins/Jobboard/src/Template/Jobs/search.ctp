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
  
<div class="row">  

<div class="col-md-4 col-md-offset-2">
<div class="contentbox">
  <h2>Search Jobs by Skill</h2>
  <BR>
  <?php echo $this->Form->create('Job',['url'=>['plugin'=>'Jobboard','controller'=>'jobs','action'=>'index']]); ?>
  <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'skillsearch']); ?>
  <input value="activate selector" id="activate_selectator4" type="button">
  
  <small>Start typing..</small>
    <select name="skill[]" multiple="multiple" class="select4" size="7" style="display: none;">
    <?php
    
    foreach($jobskillsdistinct as $key => $name){
      if(!empty($showskill_list)) {
        if (array_key_exists($key, $showskill_list)) { echo '<option value="'.$key.'" selected>'.$name.'</option>'; } else { echo '<option value="'.$key.'">'.$name.'</option>'; }
      } else {
        echo '<option value="'.$key.'">'.$name.'</option>';
      } 
    }
    
    ?>
     </select>
     <BR><BR>
        <?= $this->Form->button(__('Search'), ['class'=>'btn btn-primary btn-login float-right'] ) ?>
    <BR><BR>
</div>
</div>

<div class="col-md-2">
<div class="contentbox">
  <small><?php echo $industry; ?></small><BR>
  <span onClick="sendajax('/jobboard/jobs/changeindustrymodal/')" class="btn btn-primary btn-xs">Change</span>
</div> <BR>
<div class="contentbox">
  <small><?php echo $country; ?></small><BR>
  <span onClick="sendajax('/jobboard/jobs/changecountrymodal/')" class="btn btn-primary btn-xs">Change</span>
</div>
<BR>
</div>

</div>