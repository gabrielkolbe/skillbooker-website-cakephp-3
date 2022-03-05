
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Resume'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Resumes') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('downloads') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_searchable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userResumes as $userResume): ?>
            <tr>
                <td><?= $this->Number->format($userResume->id) ?></td>
                <td><?= $userResume->has('user') ? $this->Html->link($userResume->user->name, ['controller' => 'Users', 'action' => 'view', $userResume->user->id]) : '' ?></td>
                <td><?= $this->Number->format($userResume->downloads) ?></td>
                <td><?= $this->Number->format($userResume->is_searchable) ?></td>
                <td><?= $this->Number->format($userResume->status) ?></td>
                <td><?= h($userResume->created) ?></td>
                <td><?= h($userResume->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userResume->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userResume->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userResume->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userResume->id), 'class' => 'btn btn-danger btn-xs']) ?>
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