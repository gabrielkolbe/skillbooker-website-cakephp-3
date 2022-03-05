
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Rating'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Ratings') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stars') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userRatings as $userRating): ?>
            <tr>
                <td><?= $this->Number->format($userRating->id) ?></td>
                <td><?= h($userRating->name) ?></td>
                <td><?= $this->Number->format($userRating->stars) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userRating->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userRating->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userRating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userRating->id), 'class' => 'btn btn-danger btn-xs']) ?>
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