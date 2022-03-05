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
	<div class="col-md-12">
 <h1>Navigation Menu's</h1> 
    <?= $this->Form->create($navigation) ?>
    <input value="activate selector" id="activate_selectator4" type="button">
    <fieldset>
        <legend><?= __('Edit Navigation') ?></legend>
        <small>Select a Tab (you created) to display in this menu</small>
        <?php
            echo $this->Form->input('title', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Menu Name']);
            echo $this->Form->input('tabs._ids', ['options' => $tabs, 'class'=>'form-control select4', 'label' => false,]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
