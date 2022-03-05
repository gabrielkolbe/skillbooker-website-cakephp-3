
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($skill) ?>
    <fieldset>
        <legend><?= __('Add Skill') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('industry_id', ['class'=>'form-control', 'label' => false, 'default' => 20]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>