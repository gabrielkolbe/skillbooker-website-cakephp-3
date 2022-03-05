<div class="row">
	<div class="col-md-12">
    <legend><?= h($jobapplication->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $jobapplication->has('user') ? $this->Html->link($jobapplication->user->name, ['controller' => 'Users', 'action' => 'view', $jobapplication->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Job') ?></th>
            <td><?= $jobapplication->has('job') ? $this->Html->link($jobapplication->job->title, ['controller' => 'Jobs', 'action' => 'view', $jobapplication->job->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Applicationstatus') ?></th>
            <td><?= $jobapplication->has('applicationstatus') ? $this->Html->link($jobapplication->applicationstatus->id, ['controller' => 'Applicationstatuses', 'action' => 'view', $jobapplication->applicationstatus->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($jobapplication->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Applicationdate') ?></th>
            <td><?= h($jobapplication->applicationdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($jobapplication->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($jobapplication->modified) ?></td>
        </tr>
    </table>
</div>
</div>