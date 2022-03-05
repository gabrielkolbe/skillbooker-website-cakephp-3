
<div class="row">
	<div class="col-md-12">
     <div class="contentbox padding15">
    <legend><?= __('Timesheet Users') ?></legend>
<span onClick="sendajax('/TimesheetUsers/add/')" class="btn btn-primary float-right">New Timesheet User</span> 
<?= $this->Html->link(__('Create a Timesheet'), ['plugin' => null, 'controller' => 'timesheets', 'action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>
<div><BR><BR>&nbsp;</div>


    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timesheetUsers as $timesheetUser): ?>
            <tr>
                <td><?= $timesheetUser->has('role') ?$timesheetUser->role->name : '' ?></td>
                <td><?= h($timesheetUser->name) ?></td>
                <td><?= h($timesheetUser->email) ?></td>
                <td><?= h($timesheetUser->created) ?></td>
                <td class="actions">
                  <span onClick="sendajax('/TimesheetUsers/edit/<?php echo $timesheetUser->slug; ?>')" class="btn btn-primary btn-xs">Edit</span> 
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timesheetUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timesheetUser->name), 'class' => 'btn btn-danger btn-xs']) ?>
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