<div class="row">
	<div class="col-md-12">  
   <?= $this->Html->link('Add Custom Page', ['action' => 'add'], ['class' => 'btn btn-primary float-right'] ) ?>

    <h3><?= __('Custom Pages') ?></h3>
    <small>NOTE: Custom Pages needs a 'TAb' before they can display</small> 
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th  width="45%" scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th  width="20%" scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th  width="20%" scope="col"><?= $this->Paginator->sort('layout') ?></th>
                <th width="15%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($custompages as $custompage): ?>
            <tr>
                <td><?= h($custompage->title) ?></td>
                <td><?= h($custompage->slug) ?></td>
                <td><?= h($custompage->layout) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $custompage->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $custompage->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $custompage->id], ['confirm' => __('Are you sure you want to delete this custom page?', $custompage->id), 'class' => 'btn btn-danger btn-xs']) ?>
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
