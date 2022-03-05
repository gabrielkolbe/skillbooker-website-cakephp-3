<div class="row">
	<div class="col-md-12">
    <legend><?= h($tutorialComment->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Parent Tutorial Comment') ?></th>
            <td><?= $tutorialComment->has('parent_tutorial_comment') ? $this->Html->link($tutorialComment->parent_tutorial_comment->id, ['controller' => 'TutorialComments', 'action' => 'view', $tutorialComment->parent_tutorial_comment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $tutorialComment->has('user') ? $this->Html->link($tutorialComment->user->name, ['controller' => 'Users', 'action' => 'view', $tutorialComment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tutorial') ?></th>
            <td><?= $tutorialComment->has('tutorial') ? $this->Html->link($tutorialComment->tutorial->name, ['controller' => 'Tutorials', 'action' => 'view', $tutorialComment->tutorial->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($tutorialComment->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Userslug') ?></th>
            <td><?= h($tutorialComment->userslug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Useravatar') ?></th>
            <td><?= h($tutorialComment->useravatar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tutorialComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Parent') ?></th>
            <td><?= $this->Number->format($tutorialComment->is_parent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Child') ?></th>
            <td><?= $this->Number->format($tutorialComment->is_child) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Approved') ?></th>
            <td><?= $this->Number->format($tutorialComment->approved) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($tutorialComment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($tutorialComment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($tutorialComment->comment)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tutorial Comments') ?></h4>
        <?php if (!empty($tutorialComment->child_tutorial_comments)): ?>
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
            <?php foreach ($tutorialComment->child_tutorial_comments as $childTutorialComments): ?>
            <tr>
                <td><?= h($childTutorialComments->id) ?></td>
                <td><?= h($childTutorialComments->is_parent) ?></td>
                <td><?= h($childTutorialComments->is_child) ?></td>
                <td><?= h($childTutorialComments->parent_id) ?></td>
                <td><?= h($childTutorialComments->user_id) ?></td>
                <td><?= h($childTutorialComments->comment) ?></td>
                <td><?= h($childTutorialComments->approved) ?></td>
                <td><?= h($childTutorialComments->tutorial_id) ?></td>
                <td><?= h($childTutorialComments->username) ?></td>
                <td><?= h($childTutorialComments->userslug) ?></td>
                <td><?= h($childTutorialComments->useravatar) ?></td>
                <td><?= h($childTutorialComments->created) ?></td>
                <td><?= h($childTutorialComments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TutorialComments', 'action' => 'view', $childTutorialComments->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TutorialComments', 'action' => 'edit', $childTutorialComments->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TutorialComments', 'action' => 'delete', $childTutorialComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childTutorialComments->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>