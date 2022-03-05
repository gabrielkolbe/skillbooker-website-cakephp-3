
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userEmployment) ?>
    <fieldset>
        <legend><?= __('Edit User Employment') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('position', ['class'=>'form-control', 'label' => false, 'placeholder'=>'position']);
            echo $this->Form->input('company', ['class'=>'form-control', 'label' => false, 'placeholder'=>'company']);
            echo $this->Form->input('job_location', ['class'=>'form-control', 'label' => false, 'placeholder'=>'job_location']);
            echo $this->Form->input('from_date', ['empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('to_date', ['empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('is_current_job', ['class'=>'form-control', 'label' => false, 'placeholder'=>'is_current_job']);
            echo $this->Form->input('description', ['class'=>'form-control', 'label' => false, 'placeholder'=>'description']);
            echo $this->Form->input('rank', ['class'=>'form-control', 'label' => false, 'placeholder'=>'rank']);
            echo $this->Form->input('displayme', ['class'=>'form-control', 'label' => false, 'placeholder'=>'displayme']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>