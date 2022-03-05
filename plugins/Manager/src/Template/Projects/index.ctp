
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Project'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Projects') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('projecttype') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_abbrev') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('twittercount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bids') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= $this->Number->format($project->id) ?></td>
                <td><?= h($project->name) ?><BR>
                https://www.skillbooker.com/projects/fullview/<?= $project->slug ?></td>
                <td><?= $this->Number->format($project->projecttype) ?></td>
                <td><?= h($project->currency_abbrev) ?></td>
                <td><?= $this->Number->format($project->amount) ?></td>
                <td><?= $this->Number->format($project->twittercount) ?></td>
                <td><?= h($project->status) ?></td>
                <td><?= $this->Number->format($project->bids) ?></td>
                <td><?= h($project->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Twitter'), ['action' => 'totwitter', $project->id], ['class' => 'btn btn-info btn-xs']) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $project->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $project->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id), 'class' => 'btn btn-danger btn-xs']) ?>
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