<div class="row">
	<div class="col-md-12">
    <legend><?= h($userEmployment->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userEmployment->has('user') ? $this->Html->link($userEmployment->user->name, ['controller' => 'Users', 'action' => 'view', $userEmployment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= h($userEmployment->position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= h($userEmployment->company) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Job Location') ?></th>
            <td><?= h($userEmployment->job_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userEmployment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Current Job') ?></th>
            <td><?= $this->Number->format($userEmployment->is_current_job) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rank') ?></th>
            <td><?= $this->Number->format($userEmployment->rank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Displayme') ?></th>
            <td><?= $this->Number->format($userEmployment->displayme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From Date') ?></th>
            <td><?= h($userEmployment->from_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To Date') ?></th>
            <td><?= h($userEmployment->to_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userEmployment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userEmployment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($userEmployment->description)); ?>
    </div>
</div>
</div>