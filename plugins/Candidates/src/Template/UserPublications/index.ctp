
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Publication'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Publications') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('publisher') ?></th>
                <th scope="col"><?= $this->Paginator->sort('publishdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('displayme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userPublications as $userPublication): ?>
            <tr>
                <td><?= $this->Number->format($userPublication->id) ?></td>
                <td><?= $userPublication->has('user') ? $this->Html->link($userPublication->user->name, ['controller' => 'Users', 'action' => 'view', $userPublication->user->id]) : '' ?></td>
                <td><?= h($userPublication->name) ?></td>
                <td><?= h($userPublication->publisher) ?></td>
                <td><?= h($userPublication->publishdate) ?></td>
                <td><?= $this->Number->format($userPublication->rank) ?></td>
                <td><?= $this->Number->format($userPublication->displayme) ?></td>
                <td><?= h($userPublication->created) ?></td>
                <td><?= h($userPublication->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userPublication->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userPublication->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userPublication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userPublication->id), 'class' => 'btn btn-danger btn-xs']) ?>
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