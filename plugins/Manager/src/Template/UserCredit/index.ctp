
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Credit'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Credit') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jobs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subscriptionlevel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subscriptiondate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userCredit as $userCredit): ?>
            <tr>
                <td><?= $this->Number->format($userCredit->id) ?></td>
                <td><?= $userCredit->has('user') ? $this->Html->link($userCredit->user->name, ['controller' => 'Users', 'action' => 'view', $userCredit->user->id]) : '' ?></td>
                <td><?= $this->Number->format($userCredit->jobs) ?></td>
                <td><?= h($userCredit->subscriptionlevel) ?></td>
                <td><?= h($userCredit->subscriptiondate) ?></td>
                <td><?= h($userCredit->created) ?></td>
                <td><?= h($userCredit->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userCredit->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userCredit->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userCredit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userCredit->id), 'class' => 'btn btn-danger btn-xs']) ?>
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