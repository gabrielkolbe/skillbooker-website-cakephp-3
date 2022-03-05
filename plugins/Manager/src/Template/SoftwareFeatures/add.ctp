
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($softwareFeature) ?>
    <fieldset>
        <legend><?= __('Add Software Feature') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('software_category_id', ['options' => $softwareCategories, 'class'=>'form-control', 'label' => false, 'placeholder'=>'software_category_id']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>