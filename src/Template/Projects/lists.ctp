<?php $this->Html->css('/qtip/jquery.qtip', ['block' => true]); ?>
<?php $this->Html->script('/qtip/jquery.qtip', ['block' => 'scriptBottom']); ?>
<script>
$(document).ready(function () {


     $('.q_tip1').qtip({
     content: {
              text: 'Once bids has been received on a project it can not be edited'
          },
          style: {
              classes: 'qtip-bootstrap'
          },
    
        show: {
            effect: function() {
                $(this).slideDown();
            }
        },
        hide: {
            effect: function() {
                $(this).slideUp();
            }
        }
     });

    

});
</script>

<div class="row">
	<div class="col-md-12">
       <div class="contentbox padding15">
      <legend><?= __('My Projects') ?></legend>
  <?= $this->Html->link(__('Add Hourly Paid Project'), ['plougin' => null, 'controller' => 'projects', 'action' => 'addhourly'], ['class' => 'btn btn-primary btn-xs float-right']) ?>
  <?= $this->Html->link(__('Add Static Project'), ['plougin' => null, 'controller' => 'projects', 'action' => 'add'], ['class' => 'btn btn-primary btn-xs float-right']) ?>
  <div><BR><BR>&nbsp;</div>  

    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col" width="7%"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" width="15%"><?= $this->Paginator->sort('bids') ?></th>
                <th scope="col" width="28%"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" width="10%"><?= $this->Paginator->sort('projecttype', 'Type') ?></th>
                <th scope="col" width="7%"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" width="7%"><?= $this->Paginator->sort('awarded') ?></th>
                <th scope="col" width="8%"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" width="15%" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= h($project->status) ?></td>
                <?php if($project->status == 'Awarded') { ?>
                  <td><span onClick="sendajax('/messenger/contactuser/<?php echo $project->Freelancer['slug']; ?>')" class="btn btn-primary btn-xs">Contact <?php echo $project->Freelancer['name']; ?></span></td>
                <?php } else {  ?>
                  <td><?php if($project->currentbids > 0 ) { echo $this->Html->link($project->currentbids, ['plugin' => null, 'controller' => 'projects', 'action' => 'bids',$project->slug]); } else { echo 'none'; } ?></td>
                <?php } ?>
                <td><?= h($project->name) ?></td>
                <td><?php if($project->projecttype == 2) { echo 'Hourly Rate'; } else { echo 'Fixed Price'; } ?></td>
                <td><?= $project->denomination ?><?= $this->Number->format($project->amount) ?></td>
                <td><?= $project->denomination ?><?= $this->Number->format($project->awardedamount) ?></td>
                <td><small><?= h($project->created) ?></small></td>
                <td class="actions">
                <?php
                if($project->status == 'Live') {
                  if($project->currentbids > 0 ) { echo $this->Html->link(__('Bids'), ['plugin' => null, 'controller' => 'projects', 'action' => 'bids',$project->slug], ['class' => 'btn btn-info btn-xs']); 
                    echo '<span class="btn btn-warning btn-xs q_tip1">No Edit</span>'; 
                  } else {
                    echo $this->Html->link(__('Skills'), ['action' => 'skills', $project->slug], ['class' => 'btn btn-success btn-xs']);
                    echo $this->Html->link(__('Edit'), ['action' => 'edit', $project->slug], ['class' => 'btn btn-warning btn-xs']);  
                  }
                }
                
                if( ($project->status == 'Awarded') || ($project->status == 'Completed') )  { echo $this->Html->link(__('Progress & Payment'), ['action' => 'progress', $project->slug], ['class' => 'btn btn-warning btn-xs']).'<BR>'; }
                    
                    echo $this->Html->link(__('View'), ['action' => 'fullview', $project->slug], ['class' => 'btn btn-primary btn-xs']);
                    echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->slug], ['confirm' => __('Are you sure you want to delete  {0}?', $project->name), 'class' => 'btn btn-danger btn-xs']); 
                ?>
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
</div>