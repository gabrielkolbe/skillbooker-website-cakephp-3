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
        <h2><?= $tutorial['name'] ?></h2>
        <h3>Industry:>> <?= $industries['name'] ?></h3>
</div>
</div>
    <?= $this->Form->create() ?>

<div class="row">
  <div class="col-md-12">
  
    <p>Tutorial Skills will help candidates find the right tutorial</p>

    	<div class="row">
      <div class="col-sm-3"><input type="radio" name="skillselect" id="drop" value="drop" checked="checked"> <span class="btn btn-primary">Drop Down Selector</span> </div> 
      <div class="col-sm-3">&nbsp;</div>
      <div class="col-sm-3">&nbsp;</div>
      <div class="col-sm-3">&nbsp;</div>    
      </div>
      <BR>
      
     <div class="row drop">

    <h3>Select from drop down</h3>
    <h6>(Or just start typing.. )</h6>
    
						<div class="col-sm-12">
    <select name="drop_skill_id[]" multiple="multiple" class="select4" size="7" style="display: none;">
    <?php
    foreach($skills as $key => $jtype){
      if (array_key_exists($key, $tutorialskills)) { echo '<option value="'.$key.'" selected>'.$jtype.'</option>'; } else  echo '<option value="'.$key.'">'.$jtype.'</option>'; 
     }
    
    ?>
     </select>
        
    <?php //echo $this->Form->input('skill_id', ['multiple' => true, 'options' => $skills, 'class'=>'select4', 'size'=>'7']); 
    ?>
             <BR><BR>
            </div>
    </div>


<div class="row">
<div class="col-md-12">
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script>

$("#drop").click(function() {
   $('.list').hide("slow");
   $('.drop').show("slow");
   $('.showcontent').hide("slow");
});


</script>
