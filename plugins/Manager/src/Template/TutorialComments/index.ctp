
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Tutorial Comment'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Tutorial Comments') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_parent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_child') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('approved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tutorial_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('userslug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('useravatar') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tutorialComments as $tutorialComment): ?>
            <tr>
                <td><?= $this->Number->format($tutorialComment->id) ?></td>
                <td><?= $this->Number->format($tutorialComment->is_parent) ?></td>
                <td><?= $this->Number->format($tutorialComment->is_child) ?></td>
                <td><?= $tutorialComment->has('parent_tutorial_comment') ? $this->Html->link($tutorialComment->parent_tutorial_comment->id, ['controller' => 'TutorialComments', 'action' => 'view', $tutorialComment->parent_tutorial_comment->id]) : '' ?></td>
                <td><?= $tutorialComment->has('user') ? $this->Html->link($tutorialComment->user->name, ['controller' => 'Users', 'action' => 'view', $tutorialComment->user->id]) : '' ?></td>
                <td><?= $this->Number->format($tutorialComment->approved) ?></td>
                <td><?= $tutorialComment->has('tutorial') ? $this->Html->link($tutorialComment->tutorial->name, ['controller' => 'Tutorials', 'action' => 'view', $tutorialComment->tutorial->id]) : '' ?></td>
                <td><?= h($tutorialComment->username) ?></td>
                <td><?= h($tutorialComment->userslug) ?></td>
                <td><?= h($tutorialComment->useravatar) ?></td>
                <td><?= h($tutorialComment->created) ?></td>
                <td><?= h($tutorialComment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tutorialComment->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tutorialComment->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tutorialComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorialComment->id), 'class' => 'btn btn-danger btn-xs']) ?>
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