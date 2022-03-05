
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Add Payment') ?></legend>
        <?php
            echo $this->Form->input('txnid', ['class'=>'form-control', 'label' => false, 'placeholder'=>'txnid']);
            echo $this->Form->input('item_name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'item_name']);
            echo $this->Form->input('item_number', ['class'=>'form-control', 'label' => false, 'placeholder'=>'item_number']);
            echo $this->Form->input('payment_amount', ['class'=>'form-control', 'label' => false, 'placeholder'=>'payment_amount']);
            echo $this->Form->input('payment_status', ['class'=>'form-control', 'label' => false, 'placeholder'=>'payment_status']);
            echo $this->Form->input('payment_currency', ['class'=>'form-control', 'label' => false, 'placeholder'=>'payment_currency']);
            echo $this->Form->input('receiver_email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'receiver_email']);
            echo $this->Form->input('payer_email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'payer_email']);
            echo $this->Form->input('createdtime', ['class'=>'form-control', 'label' => false, 'placeholder'=>'createdtime']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>