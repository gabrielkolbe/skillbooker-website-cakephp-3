<div class="row">
	<div class="col-md-12">
    <legend><?= h($applicationstatus->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($applicationstatus->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicationstatus->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Jobapplications') ?></h4>
        <?php if (!empty($applicationstatus->jobapplications)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Job Id') ?></th>
                <th scope="col"><?= __('Applicationdate') ?></th>
                <th scope="col"><?= __('Applicationstatus Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($applicationstatus->jobapplications as $jobapplications): ?>
            <tr>
                <td><?= h($jobapplications->id) ?></td>
                <td><?= h($jobapplications->user_id) ?></td>
                <td><?= h($jobapplications->job_id) ?></td>
                <td><?= h($jobapplications->applicationdate) ?></td>
                <td><?= h($jobapplications->applicationstatus_id) ?></td>
                <td><?= h($jobapplications->created) ?></td>
                <td><?= h($jobapplications->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Jobapplications', 'action' => 'view', $jobapplications->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Jobapplications', 'action' => 'edit', $jobapplications->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Jobapplications', 'action' => 'delete', $jobapplications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobapplications->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>