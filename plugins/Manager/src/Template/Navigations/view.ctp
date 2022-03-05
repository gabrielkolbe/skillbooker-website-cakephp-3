<div class="row">
	<div class="col-md-12">
<?php if($navigation->isdefault == 1) { } else { echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $navigation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $navigation->id), 'class' => 'btn btn-danger float-right marginleft10'] ); } ?> 
<?php echo $this->Html->link('Edit Navigation Menu', ['controller' => 'navigation', 'action' => 'edit', $navigation->id], ['class' => 'btn btn-warning float-right'] );  ?>

<BR><BR>
     
    <h3><?= h($navigation->title) ?></H3>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($navigation->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($navigation->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($navigation->modified) ?></td>
        </tr>
    </table>
    <BR><BR>
    <div class="related">
        <h4><?= __('Related Tabs') ?></h4>
        <?php if (!empty($navigation->tabs)): ?>
            <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="60%"  scope="col"><?= __('Title') ?></th>
                <th width="10%"  scope="col"><?= __('Parent Id') ?></th>
                <th width="15%"  scope="col"><?= __('Created') ?></th>
                <th width="15%"  scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($navigation->tabs as $tabs): ?>
            <tr>
                <td><?= h($tabs->title) ?></td>
                <td><?= h($tabs->parent_id) ?></td>
                <td><?= h($tabs->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tabs', 'action' => 'view', $tabs->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tabs', 'action' => 'edit', $tabs->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?php if($tabs->isdefault <> 1) { echo $this->Form->postLink(__('Delete'), ['controller' => 'Tabs', 'action' => 'delete', $tabs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tabs->id), 'class' => 'btn btn-danger btn-xs']); } ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
