
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Question Skill'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Question Skills') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('industry_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionSkills as $questionSkill): ?>
            <tr>
                <td><?= $this->Number->format($questionSkill->id) ?></td>
                <td><?= $questionSkill->has('question') ? $this->Html->link($questionSkill->question->name, ['controller' => 'Questions', 'action' => 'view', $questionSkill->question->id]) : '' ?></td>
                <td><?= $questionSkill->has('skill') ? $this->Html->link($questionSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $questionSkill->skill->id]) : '' ?></td>
                <td><?= h($questionSkill->skill_name) ?></td>
                <td><?= h($questionSkill->slug) ?></td>
                <td><?= $questionSkill->has('industry') ? $this->Html->link($questionSkill->industry->name, ['controller' => 'Industries', 'action' => 'view', $questionSkill->industry->id]) : '' ?></td>
                <td><?= h($questionSkill->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $questionSkill->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $questionSkill->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questionSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionSkill->id), 'class' => 'btn btn-danger btn-xs']) ?>
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