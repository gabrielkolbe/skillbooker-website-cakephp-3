<div class="row">
	<div class="col-md-12">
  
   <?php echo $this->Html->link('Add Country', ['controller' => 'countries', 'action' => 'add'], ['class' => 'btn btn-primary float-right'] );  ?>
    <legend><?= __('Countries') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('iso_alpha2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('iso_alpha3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('iso_numeric') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_symbol') ?></th>
                <th scope="col"><?= $this->Paginator->sort('html_entity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($countries as $country): ?>
            <tr>
                <td><?= h($country->name) ?></td>
                <td><?= h($country->iso_alpha2) ?></td>
                <td><?= h($country->iso_alpha3) ?></td>
                <td><?= $this->Number->format($country->iso_numeric) ?></td>
                <td><?= h($country->country_currency) ?></td>
                <td><?= h($country->currency_name) ?></td>
                <td><?= h($country->currency_symbol) ?></td>
                <td><?= h($country->html_entity) ?></td>
                <td><?= h($country->flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $country->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $country->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete this country?', $country->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
