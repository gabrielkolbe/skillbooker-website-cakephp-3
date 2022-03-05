
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Tutorial'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Tutorials') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('twittercount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hitcount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tutorials as $tutorial): ?>
            <tr>
                <td><?= $this->Number->format($tutorial->id) ?></td>
                <td><?= h($tutorial->name) ?></td>
                <td><?= $this->Number->format($tutorial->twittercount) ?></td>
                <td><?= $this->Number->format($tutorial->hitcount) ?></td>
                <td><?= h($tutorial->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Twitter'), ['action' => 'totwitter', $tutorial->id], ['class' => 'btn btn-info btn-xs']) ?>
                    <?= $this->Html->link(__('Skills'), ['action' => 'skills', $tutorial->id], ['class' => 'btn btn-success btn-xs']) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tutorial->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tutorial->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tutorial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorial->id), 'class' => 'btn btn-danger btn-xs']) ?>
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