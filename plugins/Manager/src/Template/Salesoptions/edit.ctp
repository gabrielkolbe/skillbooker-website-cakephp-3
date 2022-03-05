<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($salesoption) ?>
    <fieldset>
        <legend><?= __('Edit Salesoption') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
            echo $this->Form->input('description', ['class'=>'form-control validate[blockscript] ckeditor', 'label' => false, 'placeholder'=>'description']);
            echo $this->Form->input('level', ['class'=>'form-control', 'label' => false, 'placeholder'=>'level']);
            echo $this->Form->input('price', ['class'=>'form-control', 'label' => false, 'placeholder'=>'price']);
            echo $this->Form->input('realvalue', ['class'=>'form-control', 'label' => false, 'placeholder'=>'realvalue']);
            echo $this->Form->input('savevalue', ['class'=>'form-control', 'label' => false, 'placeholder'=>'savevalue']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>