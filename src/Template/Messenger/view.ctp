
    <h2><?= h($messenger->title) ?></h2>
    <p>Send to <?php echo $this->Html->link($messenger->Receiver['name'], ['controller' => 'Users', 'action' => 'view', $messenger->Receiver['slug']]); ?></p>
    <p>On  <?= h($messenger->created) ?></p>
    <strong>Message</strong><BR>
    <?= $messenger->message; ?>
