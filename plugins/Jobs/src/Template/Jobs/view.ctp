<div class="row">
	<div class="col-md-12">
    <legend><?= h($job->title) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($job->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jobtype') ?></th>
            <td><?= $job->has('jobtype') ? $this->Html->link($job->jobtype->type, ['controller' => 'Jobtypes', 'action' => 'view', $job->jobtype->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Salary') ?></th>
            <td><?= $job->display_salary ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($job->display_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $job->has('company') ? $this->Html->link($job->company->name, ['controller' => 'Companies', 'action' => 'view', $job->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Industry') ?></th>
            <td><?= $job->has('industry') ? $this->Html->link($job->industry->name, ['controller' => 'Industries', 'action' => 'view', $job->industry->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subindustry') ?></th>
            <td><?= $job->has('subindustry') ? $this->Html->link($job->subindustry->name, ['controller' => 'Subindustries', 'action' => 'view', $job->subindustry->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($job->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($job->display_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($job->display_country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= h($job->reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Twittercount') ?></th>
            <td><?= $this->Number->format($job->twittercount) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($job->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($job->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($job->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Job Skills') ?></h4>
        <?php if (!empty($job->job_skills)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Job Id') ?></th>
                <th scope="col"><?= __('Skill Id') ?></th>
                <th scope="col"><?= __('Skill Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($job->job_skills as $jobSkills): ?>
            <tr>
                <td><?= h($jobSkills->id) ?></td>
                <td><?= h($jobSkills->job_id) ?></td>
                <td><?= h($jobSkills->skill_id) ?></td>
                <td><?= h($jobSkills->skill_name) ?></td>
                <td><?= h($jobSkills->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'JobSkills', 'action' => 'view', $jobSkills->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'JobSkills', 'action' => 'edit', $jobSkills->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'JobSkills', 'action' => 'delete', $jobSkills->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobSkills->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Jobapplications') ?></h4>
        <?php if (!empty($job->jobapplications)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Job Id') ?></th>
                <th scope="col"><?= __('Applicationdate') ?></th>
                <th scope="col"><?= __('Applicationstatus Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($job->jobapplications as $jobapplications): ?>
            <tr>
                <td><?= h($jobapplications->id) ?></td>
                <td><?= h($jobapplications->user_id) ?></td>
                <td><?= h($jobapplications->job_id) ?></td>
                <td><?= h($jobapplications->applicationdate) ?></td>
                <td><?= h($jobapplications->applicationstatus_id) ?></td>
                <td><?= h($jobapplications->created) ?></td>
                <td><?= h($jobapplications->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Jobapplications', 'action' => 'view', $jobapplications->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Jobapplications', 'action' => 'edit', $jobapplications->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Jobapplications', 'action' => 'delete', $jobapplications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobapplications->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>