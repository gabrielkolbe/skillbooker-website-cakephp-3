<div class="row">
	<div class="col-md-12">
    <legend><?= h($userQualification->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userQualification->has('user') ? $this->Html->link($userQualification->user->name, ['controller' => 'Users', 'action' => 'view', $userQualification->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $userQualification->has('country') ? $this->Html->link($userQualification->country->name, ['controller' => 'Countries', 'action' => 'view', $userQualification->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Of Qualification') ?></th>
            <td><?= h($userQualification->type_of_qualification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institution') ?></th>
            <td><?= h($userQualification->institution) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Field') ?></th>
            <td><?= h($userQualification->field) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rank') ?></th>
            <td><?= $this->Number->format($userQualification->rank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Displayme') ?></th>
            <td><?= $this->Number->format($userQualification->displayme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From Date') ?></th>
            <td><?= h($userQualification->from_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To Date') ?></th>
            <td><?= h($userQualification->to_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userQualification->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userQualification->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comments') ?></h4>
        <?= $this->Text->autoParagraph(h($userQualification->comments)); ?>
    </div>
</div>
</div>