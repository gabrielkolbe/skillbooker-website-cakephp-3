
<div class="row">
	<div class="col-md-12">

    <legend>Messenger</legend>
 
    <span class="btn btn-primary btn-xs sentbutton">Hide Sent</span><span class="btn btn-primary btn-xs receivebutton">Hide Received</span>    
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="35%" scope="col"><?= $this->Paginator->sort('Type') ?></th>
                <th width="35%" scope="col"><?= $this->Paginator->sort('title') ?></th> 
                <th width="15%" scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th width="15%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>        
        <tbody>        
            <?php foreach ($messengers as $messenger): ?>
            <?php if( $user_id == $messenger->receiver_id ) { 
             echo '<tr class="receiver"><td><img src="../img/orangearrow.png"> Received From '.$messenger->Sender['name']; } else { echo '<tr class="sender"><td><img src="../img/bluearrow.png"> Sent to '.$messenger->Receiver['name']; }  ?></td>
                <td><?= h($messenger->title) ?></td>
                <td><?= h($messenger->created) ?></td>
                <td class="actions">
                <?php if( $user_id == $messenger->receiver_id ) { ?>  <span onClick="sendajax('/messenger/reply/<?php echo $messenger->id; ?>')"  class="btn btn-primary btn-xs orange">Reply</span> <?php } ?>
                  <span onClick="sendajax('/messenger/view/<?php echo $messenger->id; ?>')"  class="btn btn-primary btn-xs">View</span>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $messenger->id], ['confirm' => __('Are you sure you want to delete this message?', $messenger->id), 'class' => 'btn btn-danger btn-xs']) ?>
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
<script type="text/javascript">

$(document).ready(function() {

    $(".sentbutton").click(function() { 
        $(".sender").hide();
        $(".receiver").show();                     
    });
    
    $(".receivebutton").click(function() { 
        $(".sender").show();
        $(".receiver").hide();                     
    });

});
</script>