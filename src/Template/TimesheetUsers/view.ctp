<div class="row">
	<div class="col-md-12">
    <legend><?= h($timesheetUser->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $timesheetUser->has('user') ? $this->Html->link($timesheetUser->user->name, ['controller' => 'Users', 'action' => 'view', $timesheetUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $timesheetUser->has('role') ? $this->Html->link($timesheetUser->role->name, ['controller' => 'Roles', 'action' => 'view', $timesheetUser->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Firstname') ?></th>
            <td><?= h($timesheetUser->firstname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lastname') ?></th>
            <td><?= h($timesheetUser->lastname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($timesheetUser->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($timesheetUser->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($timesheetUser->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Signature') ?></th>
            <td><?= h($timesheetUser->signature) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($timesheetUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registereduserid') ?></th>
            <td><?= $this->Number->format($timesheetUser->registereduserid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($timesheetUser->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($timesheetUser->modified) ?></td>
        </tr>
    </table>
</div>
</div>