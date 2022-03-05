<div class="row">
	<div class="col-md-12">
  
   <?php echo $this->Html->link('Add Email Template ', ['controller' => 'email_templates', 'action' => 'add'], ['class' => 'btn btn-primary float-right'] );  ?>
    <legend><?= __('Email Templates') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="5%" scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th width="8%" scope="col"><?= $this->Paginator->sort('bcc') ?></th>
                <th width="25%" scope="col"><?= $this->Paginator->sort('subject') ?></th>
                <th width="28%" scope="col"><?= $this->Paginator->sort('values') ?></th>
                <th width="8%"><?= $this->Paginator->sort('Layouts') ?></th>
                <th width="17%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emailTemplates as $emailTemplate): ?>
            <tr>
                 <td><?= h($emailTemplate->id) ?></td>
                <td><?php if($emailTemplate->bcc == 1){ echo 'Yes'; } else { echo 'No'; } ?> <?= h($emailTemplate->bcc_email) ?></td>
                <td><?= h($emailTemplate->subject) ?></td>
                <td><?= h($emailTemplate->constants) ?></td>
                <td><?= $emailTemplate->has('email_layout') ? $this->Html->link($emailTemplate->email_layout->name, ['controller' => 'email_layouts', 'action' => 'view', $emailTemplate->email_layout->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Test'), ['action' => 'test', $emailTemplate->id], ['class' => 'btn btn-success btn-xs']) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $emailTemplate->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $emailTemplate->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $emailTemplate->id], ['confirm' => __('Are you sure you want to delete this email template?', $emailTemplate->id), 'class' => 'btn btn-danger btn-xs']); ?>
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
