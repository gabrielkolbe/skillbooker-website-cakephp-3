<div class="row">
	<div class="col-md-12">
    <legend><?= h($userResume->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userResume->has('user') ? $this->Html->link($userResume->user->name, ['controller' => 'Users', 'action' => 'view', $userResume->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userResume->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Downloads') ?></th>
            <td><?= $this->Number->format($userResume->downloads) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Searchable') ?></th>
            <td><?= $this->Number->format($userResume->is_searchable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($userResume->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userResume->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userResume->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Resume') ?></h4>
        <?= $this->Text->autoParagraph(h($userResume->resume)); ?>
    </div>
    <div class="row">
        <h4><?= __('Resume Content') ?></h4>
        <?= $this->Text->autoParagraph(h($userResume->resume_content)); ?>
    </div>
</div>
</div>