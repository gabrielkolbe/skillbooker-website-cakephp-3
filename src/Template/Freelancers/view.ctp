<div class="row">
	<div class="col-md-12">
    <legend><?= h($freelancer->user_id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $freelancer->has('user') ? $this->Html->link($freelancer->user->name, ['controller' => 'Users', 'action' => 'view', $freelancer->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($freelancer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Freelancer') ?></th>
            <td><?= $this->Number->format($freelancer->freelancer) ?></td>
        </tr>
    </table>
</div>
</div>