<div class="row">
	<div class="col-md-12">
    <legend><?= h($skill->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($skill->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($skill->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Industry Id') ?></th>
            <td><?= $this->Number->format($skill->industry_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($skill->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($skill->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Jobskills') ?></h4>
        <?php if (!empty($skill->jobskills)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Job Id') ?></th>
                <th scope="col"><?= __('Skill Id') ?></th>
                <th scope="col"><?= __('Skill Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($skill->jobskills as $jobskills): ?>
            <tr>
                <td><?= h($jobskills->id) ?></td>
                <td><?= h($jobskills->job_id) ?></td>
                <td><?= h($jobskills->skill_id) ?></td>
                <td><?= h($jobskills->skill_name) ?></td>
                <td><?= h($jobskills->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Jobskills', 'action' => 'view', $jobskills->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Jobskills', 'action' => 'edit', $jobskills->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Jobskills', 'action' => 'delete', $jobskills->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobskills->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>