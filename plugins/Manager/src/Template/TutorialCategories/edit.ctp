
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($tutorialCategory) ?>
    <fieldset>
        <legend><?= __('Edit Tutorial Category') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
            echo $this->Form->input('tutorial_count', ['class'=>'form-control', 'label' => false, 'placeholder'=>'tutorial_count']);
            echo $this->Form->input('rank', ['class'=>'form-control', 'label' => false, 'placeholder'=>'rank']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>