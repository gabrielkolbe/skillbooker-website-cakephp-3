
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New User Skill'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('User Skills') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userSkills as $userSkill): ?>
            <tr>
                <td><?= $this->Number->format($userSkill->id) ?></td>
                <td><?= $userSkill->has('user') ? $this->Html->link($userSkill->user->name, ['controller' => 'Users', 'action' => 'view', $userSkill->user->id]) : '' ?></td>
                <td><?= $userSkill->has('skill') ? $this->Html->link($userSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $userSkill->skill->id]) : '' ?></td>
                <td><?= h($userSkill->skill_name) ?></td>
                <td><?= h($userSkill->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userSkill->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userSkill->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userSkill->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
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