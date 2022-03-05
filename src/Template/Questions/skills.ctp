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
   <span class="large-legend">Skills used or needed here</span>
   <p>This is important to help other users find your question</p>

    <?= $this->Form->create() ?>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>

    <h6>(Or just start typing.. )</h6>
    

    <select name="skill_id[]" multiple="multiple" class="select4" size="7" style="display: none;">
    <?php
    foreach($skills as $key => $name){
      if (in_array($name, $questionskills)) { echo '<option value="'.$key.'" selected>'.$name.'</option>'; } else { echo '<option value="'.$key.'">'.$name.'</option>'; }
    }
    
    ?>
     </select>
        
    <?= $this->Form->end() ?>
  </div>
</div>