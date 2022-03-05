
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($tutorialSkill) ?>
    <fieldset>
        <legend><?= __('Add Tutorial Skill') ?></legend>
        <?php
            echo $this->Form->input('tutorial_id', ['options' => $tutorials, 'class'=>'form-control', 'label' => false, 'placeholder'=>'tutorial_id']);
            echo $this->Form->input('skill_id', ['options' => $skills, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('skill_name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'skill_name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>