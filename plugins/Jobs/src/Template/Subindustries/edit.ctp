
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($subindustry) ?>
    <fieldset>
        <legend><?= __('Edit Sub Industry') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('industry_id', ['options' => $industries, 'class'=>'form-control', 'label' => false, 'placeholder'=>'industry_id']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>