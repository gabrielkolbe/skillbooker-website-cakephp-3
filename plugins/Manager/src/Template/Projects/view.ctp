<div class="row">
	<div class="col-md-12">
    <legend><?= h($project->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($project->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($project->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Industry') ?></th>
            <td><?= $project->has('industry') ? $this->Html->link($project->industry->name, ['controller' => 'Industries', 'action' => 'view', $project->industry->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $project->has('user') ? $this->Html->link($project->user->name, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= $project->has('currency') ? $this->Html->link($project->currency->name, ['controller' => 'Currencies', 'action' => 'view', $project->currency->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Denomination') ?></th>
            <td><?= h($project->denomination) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Abbrev') ?></th>
            <td><?= h($project->currency_abbrev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description') ?></th>
            <td><?= h($project->short_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($project->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skills') ?></th>
            <td><?= h($project->skills) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Human') ?></th>
            <td><?= h($project->date_human) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($project->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Awardeduser') ?></th>
            <td><?= $this->Number->format($project->awardeduser) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Projecttype') ?></th>
            <td><?= $this->Number->format($project->projecttype) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($project->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Twittercount') ?></th>
            <td><?= $this->Number->format($project->twittercount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bids') ?></th>
            <td><?= $this->Number->format($project->bids) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($project->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($project->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Stage1') ?></h4>
        <?= $this->Text->autoParagraph(h($project->stage1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Stage2') ?></h4>
        <?= $this->Text->autoParagraph(h($project->stage2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Stage3') ?></h4>
        <?= $this->Text->autoParagraph(h($project->stage3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Stage4') ?></h4>
        <?= $this->Text->autoParagraph(h($project->stage4)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Bids') ?></h4>
        <?php if (!empty($project->bids)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Owner Id') ?></th>
                <th scope="col"><?= __('Denomination') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Rating') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($project->bids as $bids): ?>
            <tr>
                <td><?= h($bids->id) ?></td>
                <td><?= h($bids->project_id) ?></td>
                <td><?= h($bids->user_id) ?></td>
                <td><?= h($bids->owner_id) ?></td>
                <td><?= h($bids->denomination) ?></td>
                <td><?= h($bids->amount) ?></td>
                <td><?= h($bids->status) ?></td>
                <td><?= h($bids->rating) ?></td>
                <td><?= h($bids->created) ?></td>
                <td><?= h($bids->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bids', 'action' => 'view', $bids->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bids', 'action' => 'edit', $bids->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bids', 'action' => 'delete', $bids->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bids->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Projectskills') ?></h4>
        <?php if (!empty($project->projectskills)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col"><?= __('Skill Id') ?></th>
                <th scope="col"><?= __('Skill Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Industry Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($project->projectskills as $projectskills): ?>
            <tr>
                <td><?= h($projectskills->id) ?></td>
                <td><?= h($projectskills->project_id) ?></td>
                <td><?= h($projectskills->skill_id) ?></td>
                <td><?= h($projectskills->skill_name) ?></td>
                <td><?= h($projectskills->slug) ?></td>
                <td><?= h($projectskills->industry_id) ?></td>
                <td><?= h($projectskills->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Projectskills', 'action' => 'view', $projectskills->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Projectskills', 'action' => 'edit', $projectskills->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projectskills', 'action' => 'delete', $projectskills->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectskills->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>