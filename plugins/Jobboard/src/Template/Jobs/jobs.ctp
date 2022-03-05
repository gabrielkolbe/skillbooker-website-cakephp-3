<span class="orangetxt float-right">You currently have <strong><?php echo $credit; ?></strong> job credits left </span>
<div class="row">
	<div class="col-md-12">

<?= $this->Html->link(__('Post A New Job'), ['action' => 'add'], ['class' => 'btn btn-primary btn-xs float-right']) ?>


     <legend><?= __('My Jobs') ?></legend>
    <BR>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col" width="50%"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col" width="10%"><?= $this->Paginator->sort('applicationcount', 'App') ?></th>
                <th scope="col" width="15%"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col" width="10%"><?= $this->Paginator->sort('created') ?></th>
      
                <th scope="col" class="actions" width="15%"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?= $this->Html->link($job->title, ['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'view', $job->slug]) ?></td>
                <td><?php if( $job->applicationcount > 0 ) { echo $this->Html->link($job->applicationcount, ['plugin' => null, 'controller' => 'applications', 'action' => 'applications', $job->id]); } ?></td>
                <td><?= h($job->city) ?></td>
                <td><?= h($job->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Skills'), ['action' => 'skills', $job->id], ['class' => 'btn btn-success btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $job->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $job->id], ['confirm' => __('Are you sure you want to delete # {0}?', $job->title), 'class' => 'btn btn-danger btn-xs']) ?>
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