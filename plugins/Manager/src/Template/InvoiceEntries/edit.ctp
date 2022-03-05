
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($invoiceEntry) ?>
    <fieldset>
        <legend><?= __('Edit Invoice Entry') ?></legend>
        <?php
            echo $this->Form->input('invoice_id', ['options' => $invoices, 'class'=>'form-control', 'label' => false, 'placeholder'=>'invoice_id']);
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('quantity', ['class'=>'form-control', 'label' => false, 'placeholder'=>'quantity']);
            echo $this->Form->input('lineprice', ['class'=>'form-control', 'label' => false, 'placeholder'=>'lineprice']);
            echo $this->Form->input('totallineprice', ['class'=>'form-control', 'label' => false, 'placeholder'=>'totallineprice']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>