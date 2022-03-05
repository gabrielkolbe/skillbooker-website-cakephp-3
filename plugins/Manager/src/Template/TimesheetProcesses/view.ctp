<div class="row">
	<div class="col-md-12">
    <legend><?= h($timesheetProcess->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($timesheetProcess->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($timesheetProcess->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($timesheetProcess->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($timesheetProcess->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Timesheets') ?></h4>
        <?php if (!empty($timesheetProcess->timesheets)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Employer') ?></th>
                <th scope="col"><?= __('Agent') ?></th>
                <th scope="col"><?= __('Days') ?></th>
                <th scope="col"><?= __('Currentmonth') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Timesheet Process Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($timesheetProcess->timesheets as $timesheets): ?>
            <tr>
                <td><?= h($timesheets->id) ?></td>
                <td><?= h($timesheets->user_id) ?></td>
                <td><?= h($timesheets->name) ?></td>
                <td><?= h($timesheets->slug) ?></td>
                <td><?= h($timesheets->employer) ?></td>
                <td><?= h($timesheets->agent) ?></td>
                <td><?= h($timesheets->days) ?></td>
                <td><?= h($timesheets->currentmonth) ?></td>
                <td><?= h($timesheets->status) ?></td>
                <td><?= h($timesheets->timesheet_process_id) ?></td>
                <td><?= h($timesheets->created) ?></td>
                <td><?= h($timesheets->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Timesheets', 'action' => 'view', $timesheets->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Timesheets', 'action' => 'edit', $timesheets->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Timesheets', 'action' => 'delete', $timesheets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timesheets->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>