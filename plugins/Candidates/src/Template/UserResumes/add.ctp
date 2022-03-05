
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userResume) ?>
    <fieldset>
        <legend><?= __('Add User Resume') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('downloads', ['class'=>'form-control', 'label' => false, 'placeholder'=>'downloads']);
            echo $this->Form->input('resume', ['class'=>'form-control', 'label' => false, 'placeholder'=>'resume']);
            echo $this->Form->input('is_searchable', ['class'=>'form-control', 'label' => false, 'placeholder'=>'is_searchable']);
            echo $this->Form->input('resume_content', ['class'=>'form-control', 'label' => false, 'placeholder'=>'resume_content']);
            echo $this->Form->input('status', ['class'=>'form-control', 'label' => false, 'placeholder'=>'status']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>