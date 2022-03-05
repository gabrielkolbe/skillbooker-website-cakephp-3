<div class="row">
	<div class="col-md-12">
  
    <?= $this->Form->create($role) ?>
    <fieldset>
        <legend><?= __('Add Role') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Role']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>

</div>
</div>