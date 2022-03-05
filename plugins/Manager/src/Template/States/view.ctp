<div class="row">
	<div class="col-md-12">
  
<?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id), 'class' => 'btn btn-danger float-right marginleft10'] );  ?> 
<?php echo $this->Html->link('Edit State', ['controller' => 'states', 'action' => 'edit', $state->id], ['class' => 'btn btn-warning float-right'] );  ?>


    <h3><?= h($state->name) ?></h3>
    <table class="table">
        <tr>
            <th scope="row"><?= __('State / County') ?></th>
            <td><?= h($state->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $state->has('country') ? $this->Html->link($state->country->name, ['controller' => 'Countries', 'action' => 'view', $state->country->id]) : '' ?></td>
        </tr>
    </table>
    
      <BR><BR>
      
      
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($state->users)): ?>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Town') ?></th>
                <th scope="col"><?= __('Jobtitle') ?></th>
                <th scope="col"><?= __('Company') ?></th>
                <th scope="col"><?= __('Industry Id') ?></th>
                <th scope="col"><?= __('Avatar') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($state->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->role_id) ?></td>
                <td><?= h($users->firstname) ?></td>
                <td><?= h($users->lastname) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->status) ?></td>
                <td><?= h($users->country_id) ?></td>
                <td><?= h($users->state_id) ?></td>
                <td><?= h($users->town) ?></td>
                <td><?= h($users->jobtitle) ?></td>
                <td><?= h($users->company) ?></td>
                <td><?= h($users->industry_id) ?></td>
                <td><?= h($users->avatar) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
