<?php echo $this->Form->create(null,  ['url' => ['plugin' => null, 'controller' => 'users', 'action' => 'deleteconfirmaction']]); ?>
 <BR><BR>
 <h1>Deleting your account will remove all your data, we will not be able to retrieve it</h1>
 <BR><BR>
<?= $this->Form->button(__('DELETE ACCOUNT'), ['class'=>'btn btn-xlarge btn-danger']) ?>
<?= $this->Form->end() ?>