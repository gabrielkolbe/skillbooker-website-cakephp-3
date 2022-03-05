<div class="row">
	<div class="col-md-12"> 
<h1>Countries</h1>
    <?= $this->Form->create($country) ?>
    <fieldset>
        <legend><?= __('Edit Country') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Country']);
            echo $this->Form->input('iso_alpha2', ['class'=>'form-control', 'label' => false, 'placeholder'=>'iso alpha 2']);
            echo $this->Form->input('iso_alpha3', ['class'=>'form-control', 'label' => false, 'placeholder'=>'iso alpha 3']);
            echo $this->Form->input('iso_numeric', ['class'=>'form-control', 'label' => false, 'placeholder'=>'iso numeric']);
            echo $this->Form->input('country_currency', ['class'=>'form-control', 'label' => false, 'placeholder'=>'currency']);
            echo $this->Form->input('currency_name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'currency name']);
            echo $this->Form->input('currency_symbol', ['class'=>'form-control', 'label' => false, 'placeholder'=>'currency symbol']);
            echo $this->Form->input('html_entity', ['class'=>'form-control', 'label' => false, 'placeholder'=>'html entity']);
            echo $this->Form->input('flag', ['class'=>'form-control', 'label' => false, 'placeholder'=>'flag']);
 
        ?>
    </fieldset>
      <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
