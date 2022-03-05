
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Tutorial Skill'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Tutorial Skills') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tutorial_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tutorialSkills as $tutorialSkill): ?>
            <tr>
                <td><?= $this->Number->format($tutorialSkill->id) ?></td>
                <td><?= $tutorialSkill->has('tutorial') ? $this->Html->link($tutorialSkill->tutorial->name, ['controller' => 'Tutorials', 'action' => 'view', $tutorialSkill->tutorial->id]) : '' ?></td>
                <td><?= $tutorialSkill->has('skill') ? $this->Html->link($tutorialSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $tutorialSkill->skill->id]) : '' ?></td>
                <td><?= h($tutorialSkill->skill_name) ?></td>
                <td><?= h($tutorialSkill->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tutorialSkill->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tutorialSkill->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tutorialSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorialSkill->id), 'class' => 'btn btn-danger btn-xs']) ?>
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