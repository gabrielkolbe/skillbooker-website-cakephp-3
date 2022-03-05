<div class="row">
	<div class="col-md-12">
    <legend><?= h($userPublication->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userPublication->has('user') ? $this->Html->link($userPublication->user->name, ['controller' => 'Users', 'action' => 'view', $userPublication->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($userPublication->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publisher') ?></th>
            <td><?= h($userPublication->publisher) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userPublication->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rank') ?></th>
            <td><?= $this->Number->format($userPublication->rank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Displayme') ?></th>
            <td><?= $this->Number->format($userPublication->displayme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publishdate') ?></th>
            <td><?= h($userPublication->publishdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userPublication->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userPublication->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Summary') ?></h4>
        <?= $this->Text->autoParagraph(h($userPublication->summary)); ?>
    </div>
</div>
</div>