
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($applicationstatus) ?>
    <fieldset>
        <legend><?= __('Edit Applicationstatus') ?></legend>
        <?php
            echo $this->Form->input('status', ['class'=>'form-control', 'label' => false, 'placeholder'=>'status']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>