
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Article Category'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Article Categories') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tutorial_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('catorder') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userArticleCategories as $userArticleCategory): ?>
            <tr>
                <td><?= $this->Number->format($userArticleCategory->id) ?></td>
                <td><?= $userArticleCategory->has('user') ? $this->Html->link($userArticleCategory->user->name, ['controller' => 'Users', 'action' => 'view', $userArticleCategory->user->id]) : '' ?></td>
                <td><?= h($userArticleCategory->category) ?></td>
                <td><?= $this->Number->format($userArticleCategory->tutorial_count) ?></td>
                <td><?= h($userArticleCategory->slug) ?></td>
                <td><?= h($userArticleCategory->color) ?></td>
                <td><?= $this->Number->format($userArticleCategory->catorder) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userArticleCategory->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userArticleCategory->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userArticleCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userArticleCategory->id), 'class' => 'btn btn-danger btn-xs']) ?>
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