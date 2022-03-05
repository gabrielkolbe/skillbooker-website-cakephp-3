<?php $this->Html->script('/js/ckeditorcode/ckeditor', ['block' => true]); ?>
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
  <div class="contentbox padding15">
    <?= $this->Form->create($question) ?>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right submit']) ?>
 <BR><BR>
<fieldset> 
<div class="row">
  <div class="col-md-12">
         <span class="large-legend">Question Title</span> 
         <?php echo $this->Form->input('name', ['class'=>'form-control', 'label' => false]); ?>
         <small>150 characters maximum</small>
</div>
 <div class="col-md-12"><BR></div>

<div class="col-md-12">  
   <span class="large-legend">Ask A Question</span>
  <?php echo $this->Form->input('content', ['class'=>'form-control  validate[blockscript] ckeditor', 'label' => false]); ?>
   </div>
 </div>
  
 <div class="col-md-12"><BR></div>  
<!--
  <div class="col-md-12">  
   <span class="large-legend">Skills used or needed here</span>
   <p>This is important to help other users find your question</p>

    <h6>(Or just start typing.. )</h6>
    
    <select name="skill_id[]" multiple="multiple" class="select4" size="7" style="display: none;">
    <?php
    foreach($skills as $key => $name){
      if (array_key_exists($key, $questionskills)) { echo '<option value="'.$key.'" selected>'.$name.'</option>'; } else { echo '<option value="'.$key.'">'.$name.'</option>'; }
    }
    
    ?>
     </select> 
</div>
-->
    </fieldset>

    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right submit']) ?>
      <BR><BR>

    <?= $this->Form->end() ?>
    </div>
</div>
</div>