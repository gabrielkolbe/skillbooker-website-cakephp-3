
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($softwareCategory) ?>
    <fieldset>
        <legend><?= __('Edit Software Category') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>