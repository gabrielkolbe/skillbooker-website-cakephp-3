
<div class="row">
	<div class="col-md-12">
    <div class="contentbox padding15">
 <legend><?= __('Timesheets') ?></legend> 
<?= $this->Html->link(__('New Timesheet'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>
<?= $this->Html->link(__('Manage Timesheet Users'), ['plugin' => null, 'controller' => 'timesheet_users', 'action' => 'index'], ['class' => 'btn btn-primary float-right']) ?>
<span onClick="sendajax('/timesheets/timesheetcycle/')" class="btn btn-primary float-right">View Timesheet Cycle</span>
<div><BR><BR>&nbsp;</div>
    
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified', 'last action') ?></th>
                <th scope="col"><?= $this->Paginator->sort('timesheet_process_id', 'action') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timesheets as $timesheet): ?>
            <tr>
                <td><?= h($timesheet->name) ?></td>
                <td><?= h($timesheet->created) ?></td>
                <td><?= h($timesheet->modified) ?></td>
                <td><?= $timesheet->has('timesheet_process') ? $timesheet->timesheet_process->name : '' ?></td>
                <td class="actions">
                     <?php if($timesheet->timesheet_process_id == 1) { echo $this->Html->link(__('Send to Employer'), ['action' => 'toempployer', $timesheet->slug], ['class' => 'btn btn-info btn-xs']); } ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $timesheet->slug], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $timesheet->slug], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timesheet->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $timesheet->slug), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    </div>
</div>
</div>