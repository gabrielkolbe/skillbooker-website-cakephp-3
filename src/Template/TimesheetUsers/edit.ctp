
<div class="row">
	<div class="col-md-12">
       <div class="contentbox padding15">
    <?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'timesheetUsers','action' => 'editaction']]); ?>
    <fieldset>
        <legend><?= __('Edit an timesheet user') ?></legend>
        <BR><BR>
        <?php
            echo $this->Form->hidden('slug', ['value'=>$timesheetUser->slug]); 
            echo $this->Form->input('role_id', ['options' => $roles, 'value'=>$timesheetUser->role_id, 'class'=>'form-control', 'label' => false, 'placeholder'=>'role_id']);
            echo $this->Form->input('firstname', ['value'=>$timesheetUser->firstname, 'class'=>'form-control', 'label' => false, 'placeholder'=>'firstname']);
            echo $this->Form->input('lastname', ['value'=>$timesheetUser->lastname, 'class'=>'form-control', 'label' => false, 'placeholder'=>'lastname']);
            echo $this->Form->input('email', ['value'=>$timesheetUser->email, 'class'=>'form-control', 'label' => false, 'placeholder'=>'email']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    <BR><BR>
</div>
</div>
</div>