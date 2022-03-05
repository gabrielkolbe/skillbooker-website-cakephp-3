
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userSkill) ?>
    <fieldset>
        <legend><?= __('Edit User Skill') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('skill_id', ['options' => $skills, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('skill_name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'skill_name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>