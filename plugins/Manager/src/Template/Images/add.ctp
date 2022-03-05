<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($image, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add Image') ?></legend>
        <?php
            echo $this->Form->input('theimage', ['type' => 'file',  'class'=>'form-control', 'label' => 'Main image']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
