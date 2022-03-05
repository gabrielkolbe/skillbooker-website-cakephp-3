
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($urlview) ?>
    <fieldset>
        <legend><?= __('Edit Urlview') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('urlcontroller_id', ['options' => $urlcontrollers, 'class'=>'form-control', 'label' => false, 'placeholder'=>'urlcontroller_id']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>