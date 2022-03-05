
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($freelancer) ?>
    <fieldset>
        <legend><?= __('Add Freelancer') ?></legend>
        <?php
            echo $this->Form->input('id', ['class'=>'form-control', 'label' => false, 'placeholder'=>'id']);
            echo $this->Form->input('freelancer', ['class'=>'form-control', 'label' => false, 'placeholder'=>'freelancer']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>