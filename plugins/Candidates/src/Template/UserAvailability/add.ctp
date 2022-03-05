
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userAvailability) ?>
    <fieldset>
        <legend><?= __('Add User Availability') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('event_date', ['class'=>'form-control', 'label' => false, 'placeholder'=>'event_date']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>