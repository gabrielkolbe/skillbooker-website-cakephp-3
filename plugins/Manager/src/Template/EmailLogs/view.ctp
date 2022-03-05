<div class="row">
	<div class="col-md-12">
    <legend><?= h($emailLog->subject) ?> <?= h($emailLog->created) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Receiver Email') ?></th>
            <td><?= h($emailLog->receiver_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sender Email') ?></th>
            <td><?= h($emailLog->sender_email) ?></td>
        </tr>        
        <tr>
            <th scope="row"><?= __('Email Template') ?></th>
            <td><?= $emailLog->email_template->id ?></td>
        </tr>
    </table>
    <?= $emailLog->message ?>
</div>
</div>