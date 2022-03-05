
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Messenger'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Messengers') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('direction') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sender_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sender_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messengers as $messenger): ?>
            <tr>
                <td><?= $this->Number->format($messenger->id) ?></td>
                <td><?= $messenger->has('user') ? $this->Html->link($messenger->user->name, ['controller' => 'Users', 'action' => 'view', $messenger->user->id]) : '' ?></td>
                <td><?= h($messenger->direction) ?></td>
                <td><?= $this->Number->format($messenger->sender_id) ?></td>
                <td><?= h($messenger->sender_email) ?></td>
                <td><?= $this->Number->format($messenger->receiver_id) ?></td>
                <td><?= h($messenger->receiver_email) ?></td>
                <td><?= h($messenger->title) ?></td>
                <td><?= h($messenger->created) ?></td>
                <td><?= h($messenger->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $messenger->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $messenger->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $messenger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messenger->id), 'class' => 'btn btn-danger btn-xs']) ?>
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