<h1><?= $this->Html->link($name, ['plugin' => null, 'controller' => 'online', 'action' => 'cv',$slug], ['target' => 'blank_']); ?>'s reason for making this bid</h1>
<BR>
<?php echo $bids->reason; ?>