<div class="row">
	<div class="col-md-12">
    <legend><?= h($payment->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Txnid') ?></th>
            <td><?= h($payment->txnid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($payment->item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Number') ?></th>
            <td><?= h($payment->item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Status') ?></th>
            <td><?= h($payment->payment_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Currency') ?></th>
            <td><?= h($payment->payment_currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver Email') ?></th>
            <td><?= h($payment->receiver_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payer Email') ?></th>
            <td><?= h($payment->payer_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($payment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Amount') ?></th>
            <td><?= $this->Number->format($payment->payment_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Createdtime') ?></th>
            <td><?= h($payment->createdtime) ?></td>
        </tr>
    </table>
</div>
</div>