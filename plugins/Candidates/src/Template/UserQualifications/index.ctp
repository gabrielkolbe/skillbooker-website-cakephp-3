
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Qualification'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Qualifications') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>                
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('institution') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userQualifications as $userQualification): ?>
            <tr>
                <td><?= $userQualification->has('user') ? $this->Html->link($userQualification->user->name, ['controller' => 'Users', 'action' => 'view', $userQualification->user->id]) : '' ?></td>
                <td><?= h($userQualification->name) ?></td>                
                <td><?= $userQualification->has('country') ? $this->Html->link($userQualification->country->name, ['controller' => 'Countries', 'action' => 'view', $userQualification->country->id]) : '' ?></td>
                <td><?= h($userQualification->institution) ?></td>
                <td><?= h($userQualification->from_date) ?></td>
                <td><?= h($userQualification->to_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userQualification->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userQualification->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userQualification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userQualification->id), 'class' => 'btn btn-danger btn-xs']) ?>
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