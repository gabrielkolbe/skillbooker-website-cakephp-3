<?php $this->Html->css('/css/cms/selector', ['block' => true]); ?>
<?php $this->Html->script('/js/cms/selector', ['block' => 'scriptBottom']); ?>
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
  
  <?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<div class="row">
	<div class="col-md-12">
   <?= $this->Form->create($event, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add Event') ?></legend>
        <?php
            echo $this->Form->input('title', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Title']);
            echo '<BR>';
            echo $this->Form->input('eventdate', ['empty' => true, 'class'=>'form-control']);
            echo '<BR>Event Start time';
            echo $this->Form->input('starttime', ['class'=>'form-control', 'label' => false, 'placeholder'=>'starttime']);
            echo 'Event End Time';
            echo $this->Form->input('endtime', ['class'=>'form-control', 'label' => false, 'placeholder'=>'endtime']);
            echo '<BR>Trainer<BR>';
            echo $this->Form->input('trainers._ids', ['options' => $trainers, 'class'=>'form-control select4', 'label' => false]);
            echo '<BR>Main Trainer Contact Number';
            echo $this->Form->input('trainer_number', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Trainer Contact Number']);
            echo '<BR>Venues<BR>';
            echo $this->Form->input('venue_id', ['class'=>'form-control', 'label' => false, 'placeholder'=>'venue_id']);
            echo $this->Form->input('attendants', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Attendees Subscribed']);
            echo $this->Form->input('places', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Places Available']);
            echo $this->Form->input('description', ['class'=>'form-control ckeditor', 'label' => false, 'placeholder'=>'Description']);
            echo '<BR>';
            echo $this->Form->input('theimage', ['type' => 'file',  'class'=>'form-control', 'label' => 'Main image']);
            echo $this->Form->input('displayimagecontent', ['type'=>'checkbox', 'class'=>'', 'label' => ' Display image in event content?']);
            echo $this->Form->input('displayimageresults', ['type'=>'checkbox', 'class'=>'', 'label' => ' Display image in row results?']);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>