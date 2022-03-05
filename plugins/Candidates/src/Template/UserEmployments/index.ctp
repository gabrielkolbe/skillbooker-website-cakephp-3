
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Employment'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Employments') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('position') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company') ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_current_job') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('displayme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userEmployments as $userEmployment): ?>
            <tr>
                <td><?= $this->Number->format($userEmployment->id) ?></td>
                <td><?= $userEmployment->has('user') ? $this->Html->link($userEmployment->user->name, ['controller' => 'Users', 'action' => 'view', $userEmployment->user->id]) : '' ?></td>
                <td><?= h($userEmployment->position) ?></td>
                <td><?= h($userEmployment->company) ?></td>
                <td><?= h($userEmployment->job_location) ?></td>
                <td><?= h($userEmployment->from_date) ?></td>
                <td><?= h($userEmployment->to_date) ?></td>
                <td><?= $this->Number->format($userEmployment->is_current_job) ?></td>
                <td><?= $this->Number->format($userEmployment->rank) ?></td>
                <td><?= $this->Number->format($userEmployment->displayme) ?></td>
                <td><?= h($userEmployment->created) ?></td>
                <td><?= h($userEmployment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userEmployment->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userEmployment->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userEmployment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userEmployment->id), 'class' => 'btn btn-danger btn-xs']) ?>
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