<div class="row">
	<div class="col-md-12">
       <div class="contentbox padding15">
           
    <legend>My Bids</legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col" width="45%"><?= $this->Paginator->sort('name', 'Project') ?></th>
                <th scope="col" width="10%"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" width="10%"><?= $this->Paginator->sort('amount', 'Project amount') ?></th>
                <th scope="col" width="10%"><?= $this->Paginator->sort('amount', 'Bid amount') ?></th>
                <th scope="col" width="15%"><?= $this->Paginator->sort('created', 'Bid date') ?></th>
                <th scope="col" width="10%" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?php echo $this->Html->link($project->name, ['plugin' => null, 'controller' => 'projects', 'action' => 'view',$project->slug ], ['target' => 'blank_']); ?></td>
                <td><small><?= h($project->Bids['status']) ?></small></td>
                <td><?= $project->denomination ?><?= $project->amount ?><?php if($project->projecttype == 2) { echo ' p/h'; } ?></td>
                <td><?= $project->Bids['denomination'] ?><?= $project->Bids['amount'] ?><?php if($project->projecttype == 2) { echo ' p/h'; } ?></td>
                <td><small><?= h($project->Bids['created']) ?></small></td>
                <td class="actions">
                    <?php if( ( $project->awardeduser == $user_id ) && ( $project->Bids['status'] == 'Awarded' ) )  {  echo $this->Html->link('Work flow', ['plugin' => null, 'controller' => 'bids', 'action' => 'workflow',$project->slug ], ['class' => 'btn btn-primary btn-xs']); } else {
                    echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->Bids['id']], ['confirm' => __('Are you sure you want to delete this project for {0}?  ', $project->name), 'class' => 'btn btn-danger btn-xs']); } ?>
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