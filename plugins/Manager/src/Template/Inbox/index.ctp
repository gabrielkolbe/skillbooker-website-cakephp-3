<div class="row">
	<div class="col-md-12">  
   <?= $this->Html->link('Add Contact History', ['action' => 'add'], ['class' => 'btn btn-primary float-right'] ) ?>
    <legend><?= __('Contact History') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th  width="25%" scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th  width="25%" scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th  width="20%" scope="col"><?= $this->Paginator->sort('tel') ?></th>
                <th  width="15%" scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th  width="15%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactHistory as $contactHistory): ?>
            <tr>
                <td><?= h($contactHistory->name) ?></td>
                <td><?= h($contactHistory->email) ?></td>
                <td><?= h($contactHistory->tel) ?></td>
                <td><?= h($contactHistory->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contactHistory->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactHistory->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactHistory->id], ['confirm' => __('Are you sure you want to delete this contact history?', $contactHistory->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
