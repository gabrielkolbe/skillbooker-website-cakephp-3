<style>
.searchinput {
    padding-left: 5px;
    vertical-align: bottom;
    width:200px;
}

.searchbutton {
margin-top: -38px;
    margin-left: 210px;
    float: left;
}

</style>

<div class="row">
	<div class="col-md-12">

<?php
echo $this->Form->create('Users');
echo $this->Form->input('search', ['class' => 'form-control searchinput', 'label' => '', 'placeholder' => 'Search Members', 'width' => '50px']);
echo $this->Form->button('', ['class'=>'fa fa-search searchbutton']);
echo $this->Form->end();
?>
      

    
   <?php echo $this->Html->link('Add User', ['controller' => 'users', 'action' => 'add'], ['class' => 'btn btn-primary float-right'] );  ?> 
  <legend><?= __('Members') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="5%" scope="col"> </th>
                <th width="25%" scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th width="20%" scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th width="10%" scope="col"><?= $this->Paginator->sort('verified') ?></th>
                <th width="5%" scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th width="10%" scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th width="20%" scope="col" width="15%" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php if(!empty($user->avatar)) { echo $this->Html->image($user->avatar, ['class'=> 'thumbnailsmall']); }   ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?php if($user->verified == 1){ echo 'Yes'; } else { echo 'No';} ?></td>
                <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                <td><?php $created = $user->created;
        echo $created->i18nFormat('dd-MM-yyyy'); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete this theme?', $user->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>