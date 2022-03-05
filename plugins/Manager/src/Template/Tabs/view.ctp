<div class="row">
	<div class="col-md-12">
<?php if($tab->isdefault == 1) { } else {  echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $tab->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tab->id), 'class' => 'btn btn-danger float-right marginleft10'] );  } ?> 
<?php echo $this->Html->link('Edit Tab', ['controller' => 'tabs', 'action' => 'edit', $tab->id], ['class' => 'btn btn-warning float-right'] );  ?>

<BR><BR>
     
     <legend><?= h($tab->title) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($tab->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($tab->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Tab') ?></th>
            <td><?= $tab->has('parent_tab') ? $this->Html->link($tab->parent_tab->title, ['controller' => 'Tabs', 'action' => 'view', $tab->parent_tab->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isdefault') ?></th>
            <td><?php if($tab->isdefault == 1) { echo 'Yes'; } else { echo 'No';} ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($tab->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($tab->modified) ?></td>
        </tr>
    </table>
    <BR><BR>
    <div class="related">
        <h4><?= __('Child Tabs') ?></h4>
        <?php if (!empty($tab->child_tabs)): ?>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="35%" scope="col"><?= __('Title') ?></th>
                <th width="35%" scope="col"><?= __('Slug') ?></th>
                <th width="15%" scope="col"><?= __('Created') ?></th>
                <th width="15%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tab->child_tabs as $childTabs): ?>
            <tr>
                <td><?= h($childTabs->title) ?></td>
                <td><?= h($childTabs->slug) ?></td>
                <td><?= h($childTabs->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tabs', 'action' => 'view', $childTabs->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tabs', 'action' => 'edit', $childTabs->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tabs', 'action' => 'delete', $childTabs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childTabs->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <BR><BR>
    <div class="related">
        <h4><?= __('Related Navigation') ?></h4>
        <?php if (!empty($tab->navigations)): ?>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="70%"  scope="col"><?= __('Title') ?></th>
                <th width="15%"  scope="col"><?= __('Created') ?></th>
                <th width="15%"  scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tab->navigation as $navigation): ?>
            <tr>
                <td><?= h($navigations->title) ?></td>
                <td><?= h($navigations->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Navigation', 'action' => 'view', $navigations->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Navigation', 'action' => 'edit', $navigations->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?php if($navigations->isdefault == 1) { } else { echo $this->Form->postLink(__('Delete'), ['controller' => 'Navigation', 'action' => 'delete', $navigations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $navigations->id), 'class' => 'btn btn-danger btn-xs']); } ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
