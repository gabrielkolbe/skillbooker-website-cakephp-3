<div class="row">
	<div class="col-md-12">
    <legend><?= h($contactmethod->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($contactmethod->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contactmethod->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Companies') ?></h4>
        <?php if (!empty($contactmethod->companies)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Contact') ?></th>
                <th scope="col"><?= __('Position') ?></th>
                <th scope="col"><?= __('Reportto') ?></th>
                <th scope="col"><?= __('Contactmethod Id') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Landline') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Town') ?></th>
                <th scope="col"><?= __('Postcode') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Display Contactmethod') ?></th>
                <th scope="col"><?= __('Display State') ?></th>
                <th scope="col"><?= __('Display Country') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($contactmethod->companies as $companies): ?>
            <tr>
                <td><?= h($companies->id) ?></td>
                <td><?= h($companies->name) ?></td>
                <td><?= h($companies->firstname) ?></td>
                <td><?= h($companies->lastname) ?></td>
                <td><?= h($companies->contact) ?></td>
                <td><?= h($companies->position) ?></td>
                <td><?= h($companies->reportto) ?></td>
                <td><?= h($companies->contactmethod_id) ?></td>
                <td><?= h($companies->email) ?></td>
                <td><?= h($companies->landline) ?></td>
                <td><?= h($companies->mobile) ?></td>
                <td><?= h($companies->address) ?></td>
                <td><?= h($companies->state_id) ?></td>
                <td><?= h($companies->country_id) ?></td>
                <td><?= h($companies->town) ?></td>
                <td><?= h($companies->postcode) ?></td>
                <td><?= h($companies->notes) ?></td>
                <td><?= h($companies->display_contactmethod) ?></td>
                <td><?= h($companies->display_state) ?></td>
                <td><?= h($companies->display_country) ?></td>
                <td><?= h($companies->created) ?></td>
                <td><?= h($companies->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Companies', 'action' => 'view', $companies->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Companies', 'action' => 'edit', $companies->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Companies', 'action' => 'delete', $companies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $companies->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>