
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('Add Invoice') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('company_id', ['options' => $companies, 'class'=>'form-control', 'label' => false, 'placeholder'=>'company_id']);
            echo $this->Form->input('invoice_status_id', ['options' => $invoiceStatuses, 'class'=>'form-control', 'label' => false, 'placeholder'=>'invoice_status_id']);
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('currency_id', ['options' => $currencies, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('denomination', ['class'=>'form-control', 'label' => false, 'placeholder'=>'denomination']);
            echo $this->Form->input('currency_abbrev', ['class'=>'form-control', 'label' => false, 'placeholder'=>'currency_abbrev']);
            echo $this->Form->input('amount', ['class'=>'form-control', 'label' => false, 'placeholder'=>'amount']);
            echo $this->Form->input('notes', ['class'=>'form-control', 'label' => false, 'placeholder'=>'notes']);
            echo $this->Form->input('footernotes', ['class'=>'form-control', 'label' => false, 'placeholder'=>'footernotes']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>