<div class="row">
	<div class="col-md-12">
    <legend><?= h($userCredit->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userCredit->has('user') ? $this->Html->link($userCredit->user->name, ['controller' => 'Users', 'action' => 'view', $userCredit->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscriptionlevel') ?></th>
            <td><?= h($userCredit->subscriptionlevel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userCredit->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jobs') ?></th>
            <td><?= $this->Number->format($userCredit->jobs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscriptiondate') ?></th>
            <td><?= h($userCredit->subscriptiondate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userCredit->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userCredit->modified) ?></td>
        </tr>
    </table>
</div>
</div>