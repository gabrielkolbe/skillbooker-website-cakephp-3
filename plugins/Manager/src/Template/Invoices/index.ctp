
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Invoice'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Invoices') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_status_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('denomination') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_abbrev') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= $this->Number->format($invoice->id) ?></td>
                <td><?= $invoice->has('user') ? $this->Html->link($invoice->user->name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
                <td><?= $invoice->has('company') ? $this->Html->link($invoice->company->name, ['controller' => 'Companies', 'action' => 'view', $invoice->company->id]) : '' ?></td>
                <td><?= $invoice->has('invoice_status') ? $this->Html->link($invoice->invoice_status->name, ['controller' => 'InvoiceStatuses', 'action' => 'view', $invoice->invoice_status->id]) : '' ?></td>
                <td><?= h($invoice->name) ?></td>
                <td><?= $invoice->has('currency') ? $this->Html->link($invoice->currency->name, ['controller' => 'Currencies', 'action' => 'view', $invoice->currency->id]) : '' ?></td>
                <td><?= h($invoice->denomination) ?></td>
                <td><?= h($invoice->currency_abbrev) ?></td>
                <td><?= $this->Number->format($invoice->amount) ?></td>
                <td><?= h($invoice->created) ?></td>
                <td><?= h($invoice->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invoice->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
</div>