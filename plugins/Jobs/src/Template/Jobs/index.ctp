
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('Post A New Job'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Jobs') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recruiter_name', 'Recruiter') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recruiter_email', 'Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('twittercount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
      
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?= h($job->title) ?><BR>
                https://www.skillbooker.com/jobboard/jobs/view/<?= $job->slug ?></td>
                <td><?= h($job->recruiter_name) ?></td>
                <td><?= $job->recruiter_email ?></td>
                <td><?= $this->Number->format($job->twittercount) ?></td>
                <td><?= h($job->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Twitter'), ['action' => 'totwitter', $job->id], ['class' => 'btn btn-info btn-xs']) ?>
                    <?= $this->Html->link(__('Skills'), ['action' => 'skills', $job->id], ['class' => 'btn btn-success btn-xs']) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $job->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $job->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $job->id], ['confirm' => __('Are you sure you want to delete # {0}?', $job->id), 'class' => 'btn btn-danger btn-xs']) ?>
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