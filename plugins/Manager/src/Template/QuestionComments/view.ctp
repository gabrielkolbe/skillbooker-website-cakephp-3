<div class="row">
	<div class="col-md-12">
    <legend><?= h($questionComment->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $questionComment->has('user') ? $this->Html->link($questionComment->user->name, ['controller' => 'Users', 'action' => 'view', $questionComment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $questionComment->has('question') ? $this->Html->link($questionComment->question->name, ['controller' => 'Questions', 'action' => 'view', $questionComment->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($questionComment->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Userslug') ?></th>
            <td><?= h($questionComment->userslug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($questionComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Id') ?></th>
            <td><?= $this->Number->format($questionComment->parent_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($questionComment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($questionComment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($questionComment->comment)); ?>
    </div>
</div>
</div>