
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Urlplugin'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Urlplugins') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($urlplugins as $urlplugin): ?>
            <tr>
                <td><?= $this->Number->format($urlplugin->id) ?></td>
                <td><?= h($urlplugin->name) ?></td>
                <td><?= h($urlplugin->created) ?></td>
                <td><?= h($urlplugin->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $urlplugin->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $urlplugin->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $urlplugin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $urlplugin->id), 'class' => 'btn btn-danger btn-xs']) ?>
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