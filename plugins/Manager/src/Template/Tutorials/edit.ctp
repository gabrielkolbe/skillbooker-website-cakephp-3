<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($tutorial) ?>
    <fieldset>
        <legend><?= __('Edit Tutorial') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Tutorial Name']);
            echo $this->Form->input('tutorial_category_id', ['options' => $tutorialCategories, 'class'=>'form-control', 'label' => false, 'placeholder'=>'tutorial_category_id']);

  $options = array(
    '1' => 'true',
    '0' => 'false'
);
            
            echo $this->Form->input('status', ['options' => $options, 'class'=>'form-control', 'label' => false, 'placeholder'=>'tutorial_category_id']);
            echo $this->Form->input('short', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Short Description']);
            echo $this->Form->textarea('content',['class'=>'validate[blockscript] ckeditor']);
            echo '<BR>'; 
            echo $this->Form->input('source', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Source']); 

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>