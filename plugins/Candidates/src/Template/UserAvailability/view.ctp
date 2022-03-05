<div class="row">
	<div class="col-md-12">
    <legend><?= h($userAvailability->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userAvailability->has('user') ? $this->Html->link($userAvailability->user->name, ['controller' => 'Users', 'action' => 'view', $userAvailability->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userAvailability->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Date') ?></th>
            <td><?= h($userAvailability->event_date) ?></td>
        </tr>
    </table>
</div>
</div>