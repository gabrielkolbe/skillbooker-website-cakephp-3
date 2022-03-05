
<div class="row">
	<div class="col-md-12">
       <div class="contentbox padding15">
    <?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'timesheetUsers','action' => 'addaction']]); ?>
    <fieldset>
        <legend><?= __('Add a timesheet user') ?></legend>
        <BR><BR>
        <?php
            echo $this->Form->input('role_id', ['options' => $roles, 'class'=>'form-control', 'label' => false, 'placeholder'=>'role_id']);
            echo $this->Form->input('firstname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'firstname']);
            echo $this->Form->input('lastname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'lastname']);
            echo $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'email']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    <BR><BR>
</div>
</div>
</div>