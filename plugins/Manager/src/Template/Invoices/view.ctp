<div class="row">
	<div class="col-md-12">
    <legend><?= h($invoice->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $invoice->has('user') ? $this->Html->link($invoice->user->name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $invoice->has('company') ? $this->Html->link($invoice->company->name, ['controller' => 'Companies', 'action' => 'view', $invoice->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Status') ?></th>
            <td><?= $invoice->has('invoice_status') ? $this->Html->link($invoice->invoice_status->name, ['controller' => 'InvoiceStatuses', 'action' => 'view', $invoice->invoice_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($invoice->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= $invoice->has('currency') ? $this->Html->link($invoice->currency->name, ['controller' => 'Currencies', 'action' => 'view', $invoice->currency->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Denomination') ?></th>
            <td><?= h($invoice->denomination) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Abbrev') ?></th>
            <td><?= h($invoice->currency_abbrev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoice->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($invoice->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($invoice->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($invoice->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($invoice->notes)); ?>
    </div>
    <div class="row">
        <h4><?= __('Footernotes') ?></h4>
        <?= $this->Text->autoParagraph(h($invoice->footernotes)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoice Entries') ?></h4>
        <?php if (!empty($invoice->invoice_entries)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Invoice Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Lineprice') ?></th>
                <th scope="col"><?= __('Totallineprice') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoice->invoice_entries as $invoiceEntries): ?>
            <tr>
                <td><?= h($invoiceEntries->id) ?></td>
                <td><?= h($invoiceEntries->invoice_id) ?></td>
                <td><?= h($invoiceEntries->user_id) ?></td>
                <td><?= h($invoiceEntries->quantity) ?></td>
                <td><?= h($invoiceEntries->lineprice) ?></td>
                <td><?= h($invoiceEntries->totallineprice) ?></td>
                <td><?= h($invoiceEntries->created) ?></td>
                <td><?= h($invoiceEntries->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'InvoiceEntries', 'action' => 'view', $invoiceEntries->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'InvoiceEntries', 'action' => 'edit', $invoiceEntries->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'InvoiceEntries', 'action' => 'delete', $invoiceEntries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceEntries->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>