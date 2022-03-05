<div class="row">
	<div class="col-md-12">
    <legend><?= h($messenger->title) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $messenger->has('user') ? $this->Html->link($messenger->user->name, ['controller' => 'Users', 'action' => 'view', $messenger->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Direction') ?></th>
            <td><?= h($messenger->direction) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sender Email') ?></th>
            <td><?= h($messenger->sender_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver Email') ?></th>
            <td><?= h($messenger->receiver_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($messenger->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($messenger->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sender Id') ?></th>
            <td><?= $this->Number->format($messenger->sender_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver Id') ?></th>
            <td><?= $this->Number->format($messenger->receiver_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($messenger->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($messenger->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($messenger->message)); ?>
    </div>
</div>
</div>