<div class="row">
	<div class="col-md-12">
<h1>States</h1>
<?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id), 'class' => 'btn btn-danger float-right marginleft10'] );  ?>
<BR>
    <?= $this->Form->create($state) ?>
    <fieldset>
        <legend><?= __('Edit State') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'State/County']);
            echo $this->Form->input('country_id', ['options' => $countries, 'class'=>'form-control', 'label' => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id), 'class' => 'btn btn-danger'] );  ?>
</div>
