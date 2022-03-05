<div class="row">
	<div class="col-md-12">
    <legend><?= h($tutorialCategory->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($tutorialCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($tutorialCategory->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tutorialCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tutorial Count') ?></th>
            <td><?= $this->Number->format($tutorialCategory->tutorial_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rank') ?></th>
            <td><?= $this->Number->format($tutorialCategory->rank) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tutorial Comments') ?></h4>
        <?php if (!empty($tutorialCategory->tutorial_comments)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Is Parent') ?></th>
                <th scope="col"><?= __('Is Child') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Approved') ?></th>
                <th scope="col"><?= __('Tutorial Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Userslug') ?></th>
                <th scope="col"><?= __('Useravatar') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tutorialCategory->tutorial_comments as $tutorialComments): ?>
            <tr>
                <td><?= h($tutorialComments->id) ?></td>
                <td><?= h($tutorialComments->is_parent) ?></td>
                <td><?= h($tutorialComments->is_child) ?></td>
                <td><?= h($tutorialComments->parent_id) ?></td>
                <td><?= h($tutorialComments->user_id) ?></td>
                <td><?= h($tutorialComments->comment) ?></td>
                <td><?= h($tutorialComments->approved) ?></td>
                <td><?= h($tutorialComments->tutorial_id) ?></td>
                <td><?= h($tutorialComments->username) ?></td>
                <td><?= h($tutorialComments->userslug) ?></td>
                <td><?= h($tutorialComments->useravatar) ?></td>
                <td><?= h($tutorialComments->created) ?></td>
                <td><?= h($tutorialComments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TutorialComments', 'action' => 'view', $tutorialComments->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TutorialComments', 'action' => 'edit', $tutorialComments->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TutorialComments', 'action' => 'delete', $tutorialComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorialComments->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tutorials') ?></h4>
        <?php if (!empty($tutorialCategory->tutorials)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Tutorial Category Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Short') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Source') ?></th>
                <th scope="col"><?= __('Twittercount') ?></th>
                <th scope="col"><?= __('Hitcount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tutorialCategory->tutorials as $tutorials): ?>
            <tr>
                <td><?= h($tutorials->id) ?></td>
                <td><?= h($tutorials->name) ?></td>
                <td><?= h($tutorials->slug) ?></td>
                <td><?= h($tutorials->tutorial_category_id) ?></td>
                <td><?= h($tutorials->status) ?></td>
                <td><?= h($tutorials->short) ?></td>
                <td><?= h($tutorials->content) ?></td>
                <td><?= h($tutorials->source) ?></td>
                <td><?= h($tutorials->twittercount) ?></td>
                <td><?= h($tutorials->hitcount) ?></td>
                <td><?= h($tutorials->created) ?></td>
                <td><?= h($tutorials->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tutorials', 'action' => 'view', $tutorials->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tutorials', 'action' => 'edit', $tutorials->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tutorials', 'action' => 'delete', $tutorials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorials->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>