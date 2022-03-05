<div class="row">
	<div class="col-md-12">
    <legend><?= h($userArticle->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userArticle->has('user') ? $this->Html->link($userArticle->user->name, ['controller' => 'Users', 'action' => 'view', $userArticle->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($userArticle->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($userArticle->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Article Category') ?></th>
            <td><?= $userArticle->has('user_article_category') ? $this->Html->link($userArticle->user_article_category->id, ['controller' => 'UserArticleCategories', 'action' => 'view', $userArticle->user_article_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short') ?></th>
            <td><?= h($userArticle->short) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Source') ?></th>
            <td><?= h($userArticle->source) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userArticle->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($userArticle->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Twittercount') ?></th>
            <td><?= $this->Number->format($userArticle->twittercount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hitcount') ?></th>
            <td><?= $this->Number->format($userArticle->hitcount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userArticle->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userArticle->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($userArticle->content)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Images') ?></h4>
        <?php if (!empty($userArticle->images)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Width') ?></th>
                <th scope="col"><?= __('Height') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($userArticle->images as $images): ?>
            <tr>
                <td><?= h($images->id) ?></td>
                <td><?= h($images->name) ?></td>
                <td><?= h($images->event_id) ?></td>
                <td><?= h($images->width) ?></td>
                <td><?= h($images->height) ?></td>
                <td><?= h($images->created) ?></td>
                <td><?= h($images->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Images', 'action' => 'view', $images->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Images', 'action' => 'edit', $images->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Images', 'action' => 'delete', $images->id], ['confirm' => __('Are you sure you want to delete # {0}?', $images->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>