<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<?php $this->Html->script('/js/jquery.validate', ['block' => true]); ?>
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($projectTemplate) ?>
    <fieldset>
        <legend><?= __('Add Project Template') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']); 
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
$options = array(
    '1' => 'Fixed Price',
    '2' => 'Hourly Rate'
);
            echo $this->Form->input('projecttype', ['options' => $options, 'class'=>'form-control', 'label' => false, 'empty'=>'Select Project Type >>']);

            echo $this->Form->input('stage1', ['class'=>'form-control ckeditor', 'label' => false, 'placeholder'=>'stage1']);
            echo $this->Form->input('stage2', ['class'=>'form-control ckeditor', 'label' => false, 'placeholder'=>'stage2']);
            echo $this->Form->input('stage3', ['class'=>'form-control ckeditor', 'label' => false, 'placeholder'=>'stage3']);
            echo $this->Form->input('stage4', ['class'=>'form-control ckeditor', 'label' => false, 'placeholder'=>'stage4']);
            echo $this->Form->input('short_description', ['class'=>'form-control', 'label' => false, 'placeholder'=>'short_description']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>