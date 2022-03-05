
<div class="row">

  <div class="col-xs-12 col-md-12">
    <?= $this->Html->link(__('Ask A Question'), ['plougin' => null, 'controller' => 'questions', 'action' => 'ask'], ['class' => 'btn btn-primary btn-xs float-right']) ?>
    <BR>
    <h1 class="toph1">My Questions</h1>
  </div>
  
	<div class="col-md-12">
  <div class="contentbox padding15">

    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col" width="5%"><?= $this->Paginator->sort('votes') ?></th>
                <th scope="col" width="5%"><?= $this->Paginator->sort('answers') ?></th>
                <th scope="col" width="5%"><?= $this->Paginator->sort('hitcount', 'Views') ?></th>                                
                <th scope="col" width="60%"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" width="15%" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= $question->votes ?></td>
                <td><?= $question->answers ?></td>
                <td><?= $question->hitcount ?></td>
                <td>
                <?= $this->Html->link($question->name, ['controller' => 'Questions', 'action' => 'view', $question->slug]); ?></td> 
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->slug], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?php 
                    if($question->answers < 1) { 
                      echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $question->name), 'class' => 'btn btn-danger btn-xs']);
                    } else { ?>
                    <span onClick="sendajax('/questions/delete_question_modal/<?php echo $question->slug; ?>')" class="btn btn-danger btn-xs">Delete</span>
                    <?php } ?>
                </td>   
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  
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