<div class="row">
	<div class="col-md-12"> 
<h1>States</h1>
    <?= $this->Form->create($state) ?>
    <fieldset>
        <legend><?= __('Add State') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'State/County']);
            echo $this->Form->input('country_id', ['options' => $countries, 'class'=>'form-control', 'label' => false, 'default' => $sitedefaultcountryid]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
