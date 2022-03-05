
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Article'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Articles') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_article_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('short') ?></th>
                <th scope="col"><?= $this->Paginator->sort('source') ?></th>
                <th scope="col"><?= $this->Paginator->sort('twittercount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hitcount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userArticles as $userArticle): ?>
            <tr>
                <td><?= $this->Number->format($userArticle->id) ?></td>
                <td><?= $userArticle->has('user') ? $this->Html->link($userArticle->user->name, ['controller' => 'Users', 'action' => 'view', $userArticle->user->id]) : '' ?></td>
                <td><?= h($userArticle->name) ?></td>
                <td><?= h($userArticle->slug) ?></td>
                <td><?= $userArticle->has('user_article_category') ? $this->Html->link($userArticle->user_article_category->id, ['controller' => 'UserArticleCategories', 'action' => 'view', $userArticle->user_article_category->id]) : '' ?></td>
                <td><?= $this->Number->format($userArticle->status) ?></td>
                <td><?= h($userArticle->short) ?></td>
                <td><?= h($userArticle->source) ?></td>
                <td><?= $this->Number->format($userArticle->twittercount) ?></td>
                <td><?= $this->Number->format($userArticle->hitcount) ?></td>
                <td><?= h($userArticle->created) ?></td>
                <td><?= h($userArticle->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userArticle->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userArticle->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userArticle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userArticle->id), 'class' => 'btn btn-danger btn-xs']) ?>
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