<div class="row">
	<div class="col-md-12">
    <legend><?= h($industry->name) ?></legend>

    <div class="related">
        <h4><?= __('Related Jobs') ?></h4>
        <?php if (!empty($industry->jobs)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Jobtype Id') ?></th>
                <th scope="col"><?= __('Jobstatus Id') ?></th>
                <th scope="col"><?= __('Jobsalarytype Id') ?></th>
                <th scope="col"><?= __('Currency') ?></th>
                <th scope="col"><?= __('Min Salary') ?></th>
                <th scope="col"><?= __('Max Salary') ?></th>
                <th scope="col"><?= __('Salary') ?></th>
                <th scope="col"><?= __('Jobsalarydesc Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Startdate') ?></th>
                <th scope="col"><?= __('Enddate') ?></th>
                <th scope="col"><?= __('Datedisplay') ?></th>
                <th scope="col"><?= __('Jobdatedesc Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Industry Id') ?></th>
                <th scope="col"><?= __('Subindustry Id') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Reference') ?></th>
                <th scope="col"><?= __('Twittercount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($industry->jobs as $jobs): ?>
            <tr>
                <td><?= h($jobs->id) ?></td>
                <td><?= h($jobs->title) ?></td>
                <td><?= h($jobs->user_id) ?></td>
                <td><?= h($jobs->jobtype_id) ?></td>
                <td><?= h($jobs->jobstatus_id) ?></td>
                <td><?= h($jobs->jobsalarytype_id) ?></td>
                <td><?= h($jobs->currency) ?></td>
                <td><?= h($jobs->min_salary) ?></td>
                <td><?= h($jobs->max_salary) ?></td>
                <td><?= h($jobs->salary) ?></td>
                <td><?= h($jobs->jobsalarydesc_id) ?></td>
                <td><?= h($jobs->description) ?></td>
                <td><?= h($jobs->startdate) ?></td>
                <td><?= h($jobs->enddate) ?></td>
                <td><?= h($jobs->datedisplay) ?></td>
                <td><?= h($jobs->jobdatedesc_id) ?></td>
                <td><?= h($jobs->company_id) ?></td>
                <td><?= h($jobs->industry_id) ?></td>
                <td><?= h($jobs->subindustry_id) ?></td>
                <td><?= h($jobs->city) ?></td>
                <td><?= h($jobs->state) ?></td>
                <td><?= h($jobs->state_id) ?></td>
                <td><?= h($jobs->country_id) ?></td>
                <td><?= h($jobs->reference) ?></td>
                <td><?= h($jobs->twittercount) ?></td>
                <td><?= h($jobs->created) ?></td>
                <td><?= h($jobs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Jobs', 'action' => 'view', $jobs->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Jobs', 'action' => 'edit', $jobs->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Jobs', 'action' => 'delete', $jobs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobs->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Subindustries') ?></h4>
        <?php if (!empty($industry->subindustries)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($industry->subindustries as $subindustries): ?>
            <tr>

                <td><?= h($subindustries->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subindustries', 'action' => 'view', $subindustries->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subindustries', 'action' => 'edit', $subindustries->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subindustries', 'action' => 'delete', $subindustries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subindustries->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>