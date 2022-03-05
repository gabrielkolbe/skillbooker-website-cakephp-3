<div class="row">
	<div class="col-md-12">
  
  <?= $this->Html->link(__('Back -> My Projects'), ['action' => 'list'], ['class' => 'btn btn-primary float-right']) ?>

    <legend>Bids <?php if(!empty($project->name)) { echo 'for '.$project->name; } ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col" width="14%"><?= $this->Paginator->sort('name', 'Name & Portfolio') ?></th>
                <th scope="col" width="27%"><?= $this->Paginator->sort('name', 'Project') ?></th>
                <th scope="col" width="8%"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" width="8%"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" width="8%"><?= $this->Paginator->sort('rating') ?></th>
                <th scope="col" width="10%"><?= $this->Paginator->sort('created', 'bid date') ?></th>
                <th scope="col" width="25%" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bids as $bid): ?>
            <tr>
                <td><?= $this->Html->link($bid->Users['name'], ['plugin' => null, 'controller' => 'online', 'action' => 'cv',$bid->Users['slug'] ], ['target' => 'blank_']); ?></td>
                <td><?= $this->Html->link($bid->Projects['name'], ['plugin' => null, 'controller' => 'projects', 'action' => 'view',$bid->Projects['slug'] ], ['target' => 'blank_']); ?></td>
                <td><?= $bid->denomination ?><?= $bid->amount ?></td>
                <td><?= h($bid->status) ?></td>
                <td>
                 <?php if($bid->status == 'Submitted') { ?>
                      <span onClick="sendajax('/projects/ratebid_modal/<?php echo $bid->id; ?>')"><img src="/img/<?= $bid->rating ?>littlestar.png" style="width:84px; height:auto;"></td></span>
                <?php } ?>
               
                <td><small><?= h($bid->created) ?></small></td>
                <td class="actions">
                <?php if($bid->status == 'Submitted') { ?>
                      <span onClick="sendajax('/projects/ratebid_modal/<?php echo $bid->id; ?>')" class="btn btn-primary btn-xs">Rate</span>
                      <span onClick="sendajax('/projects/allocate/<?php echo $bid->id; ?>')" class="btn btn-warning btn-xs">Allocate</span>
                      <span onClick="sendajax('/bids/reason_modal/<?php echo $bid->id; ?>')" class="btn btn-info btn-xs">Reason</span>
                <?php } ?>
                <?php if($bid->status == 'Awarded') { ?>
                      <span onClick="sendajax('/messenger/contactuser/<?php echo $bid->Users['slug']; ?>')" class="btn btn-primary btn-xs">Contact</span>
                <?php } ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'removebid', $bid->id], ['confirm' => __('Are you sure you want to delete this bid by {0}?  ', $bid->Users['name']), 'class' => 'btn btn-danger btn-xs']) ?>
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