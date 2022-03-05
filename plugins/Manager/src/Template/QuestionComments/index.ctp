
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Question Comment'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Question Comments') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('userslug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionComments as $questionComment): ?>
            <tr>
                <td><?= $this->Number->format($questionComment->id) ?></td>
                <td><?= $questionComment->has('user') ? $this->Html->link($questionComment->user->name, ['controller' => 'Users', 'action' => 'view', $questionComment->user->id]) : '' ?></td>
                <td><?= $questionComment->has('question') ? $this->Html->link($questionComment->question->name, ['controller' => 'Questions', 'action' => 'view', $questionComment->question->id]) : '' ?></td>
                <td><?= $this->Number->format($questionComment->parent_id) ?></td>
                <td><?= h($questionComment->username) ?></td>
                <td><?= h($questionComment->userslug) ?></td>
                <td><?= h($questionComment->created) ?></td>
                <td><?= h($questionComment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $questionComment->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $questionComment->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questionComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionComment->id), 'class' => 'btn btn-danger btn-xs']) ?>
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