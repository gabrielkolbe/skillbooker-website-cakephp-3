<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<div class="row">
	<div class="col-md-12">
 <h1>Email Templates</h1> 
    <?= $this->Form->create($emailTemplate) ?>
    <fieldset>
        <legend><?= __('Add Email Template') ?></legend>
        <?php
            echo '<BR>SUBJECT';
            echo $this->Form->input('subject', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Email Subject']);
            echo $this->Form->input('body', ['class'=>'form-control  ckeditor', 'label' => false, 'placeholder'=>'Email Body']);
            echo '<BR>DESCRIPTION';
            echo $this->Form->input('description', ['class'=>'form-control  ckeditor', 'label' => false, 'placeholder'=>'Description']);
            echo $this->Form->input('bcc', ['type'=>'checkbox', 'class'=>'', 'label' => ' BCC Site?']);
            echo $this->Form->input('bcc_email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'BCC email']);
            echo $this->Form->input('layout_id', ['options' => $layouts, 'class'=>'form-control', 'label' => false]);           
            echo '<BR>DO NOT CHANGE IF NOT CONSULTED WITH A DEVELOPER !!';
            echo $this->Form->input('constants', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Constants']);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
