
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userRating) ?>
    <fieldset>
        <legend><?= __('Add User Rating') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('stars', ['class'=>'form-control', 'label' => false, 'placeholder'=>'stars']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>