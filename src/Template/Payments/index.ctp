
<div class="row">
	<div class="col-md-12">

    <legend>Payments</legend>
    <span class="btn btn-primary btn-xs sentbutton">Hide Paid</span><span class="btn btn-primary btn-xs receivebutton">Hide Received</span>  
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('item_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payer_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('createdtime') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment): ?>
            <?php if( $payment->direction == 'Received' ) { 
             echo '<tr class="receiver"><td><img src="../img/orangearrow.png"> Received for '.$payment->item_name; } else { echo '<tr class="sender"><td><img src="../img/bluearrow.png"> Paid for '.$payment->item_name; }  ?></td>
                <td><?= h($payment->payment_currency) ?><?= $this->Number->format($payment->payment_amount) ?></td>
                <td><?= h($payment->receiver_email) ?></td>
                <td><?= h($payment->payer_email) ?></td>
                <td><?= h($payment->createdtime) ?></td>
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