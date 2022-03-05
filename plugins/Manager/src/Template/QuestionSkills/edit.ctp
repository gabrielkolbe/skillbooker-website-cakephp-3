
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($questionSkill) ?>
    <fieldset>
        <legend><?= __('Edit Question Skill') ?></legend>
        <?php
            echo $this->Form->input('question_id', ['options' => $questions, 'class'=>'form-control', 'label' => false, 'placeholder'=>'question_id']);
            echo $this->Form->input('skill_id', ['options' => $skills, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('skill_name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'skill_name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
            echo $this->Form->input('industry_id', ['options' => $industries, 'class'=>'form-control', 'label' => false, 'placeholder'=>'industry_id']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>