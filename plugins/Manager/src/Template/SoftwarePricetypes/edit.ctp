
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($softwarePricetype) ?>
    <fieldset>
        <legend><?= __('Edit Software Pricetype') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>