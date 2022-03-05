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
<div class="col-md-12">
        <h2>Select Job Skills from Industry: <?= $industries['name'] ?></h2>

    <?= $this->Form->create() ?>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  
    <h4>Job Skills will help candidates find the right job</h4>

    <h6>(Or just start typing.. )</h6>
    

    <select name="skill_id[]" multiple="multiple" class="select4" size="7" style="display: none;">
    <?php
    foreach($skills as $key => $jtype){
      if (in_array($jtype, $jobskills)) { echo '<option value="'.$key.'" selected>'.$jtype.'</option>'; } else  echo '<option value="'.$key.'">'.$jtype.'</option>'; 
     }
    
    ?>
     </select>
        
    <?= $this->Form->end() ?>
  </div>
</div>