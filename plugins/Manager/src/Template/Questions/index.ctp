
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Question'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Questions') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('twittercount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hitcount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('votes') ?></th>
                <th scope="col"><?= $this->Paginator->sort('answers') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= $this->Number->format($question->id) ?></td>
                <td><?= h($question->name) ?></td>
                <td><?= $this->Number->format($question->status) ?></td>
                <td><?= $this->Number->format($question->twittercount) ?></td>
                <td><?= $this->Number->format($question->hitcount) ?></td>
                <td><?= $this->Number->format($question->votes) ?></td>
                <td><?= $this->Number->format($question->answers) ?></td>
                <td><?= h($question->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Twitter'), ['action' => 'totwitter', $question->id], ['class' => 'btn btn-info btn-xs']) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $question->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id), 'class' => 'btn btn-danger btn-xs']) ?>
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