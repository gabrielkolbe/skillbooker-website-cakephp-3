
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Jobapplication'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Jobapplications') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicationdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicationstatus_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobapplications as $jobapplication): ?>
            <tr>
                <td><?= $this->Number->format($jobapplication->id) ?></td>
                <td><?= $jobapplication->has('user') ? $this->Html->link($jobapplication->user->name, ['controller' => 'Users', 'action' => 'view', $jobapplication->user->id]) : '' ?></td>
                <td><?= $jobapplication->has('job') ? $this->Html->link($jobapplication->job->title, ['controller' => 'Jobs', 'action' => 'view', $jobapplication->job->id]) : '' ?></td>
                <td><?= h($jobapplication->applicationdate) ?></td>
                <td><?= $jobapplication->has('applicationstatus') ? $this->Html->link($jobapplication->applicationstatus->id, ['controller' => 'Applicationstatuses', 'action' => 'view', $jobapplication->applicationstatus->id]) : '' ?></td>
                <td><?= h($jobapplication->created) ?></td>
                <td><?= h($jobapplication->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $jobapplication->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $jobapplication->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $jobapplication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobapplication->id), 'class' => 'btn btn-danger btn-xs']) ?>
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