<div class="row">
	<div class="col-md-12">
    <legend><?= h($userArticleCategory->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userArticleCategory->has('user') ? $this->Html->link($userArticleCategory->user->name, ['controller' => 'Users', 'action' => 'view', $userArticleCategory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($userArticleCategory->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($userArticleCategory->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= h($userArticleCategory->color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userArticleCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tutorial Count') ?></th>
            <td><?= $this->Number->format($userArticleCategory->tutorial_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Catorder') ?></th>
            <td><?= $this->Number->format($userArticleCategory->catorder) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User Articles') ?></h4>
        <?php if (!empty($userArticleCategory->user_articles)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('User Article Category Id') ?></th>
                <th scope="col"><?= __('Displayme') ?></th>
                <th scope="col"><?= __('Short') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Source') ?></th>
                <th scope="col"><?= __('Tags') ?></th>
                <th scope="col"><?= __('Twittercount') ?></th>
                <th scope="col"><?= __('Hitcount') ?></th>
                <th scope="col"><?= __('Rank') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($userArticleCategory->user_articles as $userArticles): ?>
            <tr>
                <td><?= h($userArticles->id) ?></td>
                <td><?= h($userArticles->user_id) ?></td>
                <td><?= h($userArticles->name) ?></td>
                <td><?= h($userArticles->slug) ?></td>
                <td><?= h($userArticles->user_article_category_id) ?></td>
                <td><?= h($userArticles->displayme) ?></td>
                <td><?= h($userArticles->short) ?></td>
                <td><?= h($userArticles->content) ?></td>
                <td><?= h($userArticles->source) ?></td>
                <td><?= h($userArticles->tags) ?></td>
                <td><?= h($userArticles->twittercount) ?></td>
                <td><?= h($userArticles->hitcount) ?></td>
                <td><?= h($userArticles->rank) ?></td>
                <td><?= h($userArticles->created) ?></td>
                <td><?= h($userArticles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserArticles', 'action' => 'view', $userArticles->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserArticles', 'action' => 'edit', $userArticles->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserArticles', 'action' => 'delete', $userArticles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userArticles->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>