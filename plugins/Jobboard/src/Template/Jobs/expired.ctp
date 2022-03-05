<div class="row">
	<div class="col-md-12">
  
    <legend><?= __('Expired Jobs') ?></legend>
    <BR>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?= $this->Html->link($job->title, ['plugin' => 'jobboard', 'controller' => 'jobs', 'action' => 'expiredjob', $job->slug]) ?></td>
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