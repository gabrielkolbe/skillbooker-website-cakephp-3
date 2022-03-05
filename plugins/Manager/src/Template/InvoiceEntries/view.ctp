<div class="row">
	<div class="col-md-12">
    <legend><?= h($invoiceEntry->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Invoice') ?></th>
            <td><?= $invoiceEntry->has('invoice') ? $this->Html->link($invoiceEntry->invoice->name, ['controller' => 'Invoices', 'action' => 'view', $invoiceEntry->invoice->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $invoiceEntry->has('user') ? $this->Html->link($invoiceEntry->user->name, ['controller' => 'Users', 'action' => 'view', $invoiceEntry->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoiceEntry->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($invoiceEntry->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lineprice') ?></th>
            <td><?= $this->Number->format($invoiceEntry->lineprice) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Totallineprice') ?></th>
            <td><?= $this->Number->format($invoiceEntry->totallineprice) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($invoiceEntry->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($invoiceEntry->modified) ?></td>
        </tr>
    </table>
</div>
</div>