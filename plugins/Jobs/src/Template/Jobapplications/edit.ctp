
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($jobapplication) ?>
    <fieldset>
        <legend><?= __('Edit Jobapplication') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('job_id', ['options' => $jobs, 'class'=>'form-control', 'label' => false, 'placeholder'=>'job_id']);
            echo $this->Form->input('applicationdate', ['class'=>'form-control', 'label' => false, 'placeholder'=>'applicationdate']);
            echo $this->Form->input('applicationstatus_id', ['options' => $applicationstatuses, 'class'=>'form-control', 'label' => false, 'placeholder'=>'applicationstatus_id']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>