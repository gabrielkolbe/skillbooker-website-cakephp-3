<div class="row">
	<div class="col-md-12">
    <legend><?= h($jobtype->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($jobtype->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($jobtype->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Candidates') ?></h4>
        <?php if (!empty($jobtype->candidates)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Candidate Status Id') ?></th>
                <th scope="col"><?= __('Candidate Rating Id') ?></th>
                <th scope="col"><?= __('Candidate Source Id') ?></th>
                <th scope="col"><?= __('Available From') ?></th>
                <th scope="col"><?= __('Industry Id') ?></th>
                <th scope="col"><?= __('Subindustry Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Jobtype Id') ?></th>
                <th scope="col"><?= __('Contactmethod Id') ?></th>
                <th scope="col"><?= __('Current Position') ?></th>
                <th scope="col"><?= __('Current Salary') ?></th>
                <th scope="col"><?= __('Ideal Jobtypeid') ?></th>
                <th scope="col"><?= __('Ideal Position') ?></th>
                <th scope="col"><?= __('Ideal Location') ?></th>
                <th scope="col"><?= __('Ideal Salary') ?></th>
                <th scope="col"><?= __('Linkedin') ?></th>
                <th scope="col"><?= __('Facebook') ?></th>
                <th scope="col"><?= __('Googleplus') ?></th>
                <th scope="col"><?= __('Twitter') ?></th>
                <th scope="col"><?= __('Website') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($jobtype->candidates as $candidates): ?>
            <tr>
                <td><?= h($candidates->id) ?></td>
                <td><?= h($candidates->candidate_status_id) ?></td>
                <td><?= h($candidates->candidate_rating_id) ?></td>
                <td><?= h($candidates->candidate_source_id) ?></td>
                <td><?= h($candidates->available_from) ?></td>
                <td><?= h($candidates->industry_id) ?></td>
                <td><?= h($candidates->subindustry_id) ?></td>
                <td><?= h($candidates->company_id) ?></td>
                <td><?= h($candidates->jobtype_id) ?></td>
                <td><?= h($candidates->contactmethod_id) ?></td>
                <td><?= h($candidates->current_position) ?></td>
                <td><?= h($candidates->current_salary) ?></td>
                <td><?= h($candidates->ideal_jobtypeid) ?></td>
                <td><?= h($candidates->ideal_position) ?></td>
                <td><?= h($candidates->ideal_location) ?></td>
                <td><?= h($candidates->ideal_salary) ?></td>
                <td><?= h($candidates->linkedin) ?></td>
                <td><?= h($candidates->facebook) ?></td>
                <td><?= h($candidates->googleplus) ?></td>
                <td><?= h($candidates->twitter) ?></td>
                <td><?= h($candidates->website) ?></td>
                <td><?= h($candidates->notes) ?></td>
                <td><?= h($candidates->created) ?></td>
                <td><?= h($candidates->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Candidates', 'action' => 'view', $candidates->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Candidates', 'action' => 'edit', $candidates->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Candidates', 'action' => 'delete', $candidates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidates->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Jobs') ?></h4>
        <?php if (!empty($jobtype->jobs)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Jobtype Id') ?></th>
                <th scope="col"><?= __('Paymentinterval Id') ?></th>
                <th scope="col"><?= __('Jobsource Id') ?></th>
                <th scope="col"><?= __('Min Salary') ?></th>
                <th scope="col"><?= __('Max Salary') ?></th>
                <th scope="col"><?= __('Salarydesc Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Startdate') ?></th>
                <th scope="col"><?= __('Enddate') ?></th>
                <th scope="col"><?= __('Datedesc Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Industry Id') ?></th>
                <th scope="col"><?= __('Subindustry Id') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Reference') ?></th>
                <th scope="col"><?= __('Twittercount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Display Date') ?></th>
                <th scope="col"><?= __('Display Salary') ?></th>
                <th scope="col"><?= __('Display State') ?></th>
                <th scope="col"><?= __('Display Country') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($jobtype->jobs as $jobs): ?>
            <tr>
                <td><?= h($jobs->id) ?></td>
                <td><?= h($jobs->title) ?></td>
                <td><?= h($jobs->user_id) ?></td>
                <td><?= h($jobs->jobtype_id) ?></td>
                <td><?= h($jobs->paymentinterval_id) ?></td>
                <td><?= h($jobs->jobsource_id) ?></td>
                <td><?= h($jobs->min_salary) ?></td>
                <td><?= h($jobs->max_salary) ?></td>
                <td><?= h($jobs->salarydesc_id) ?></td>
                <td><?= h($jobs->description) ?></td>
                <td><?= h($jobs->startdate) ?></td>
                <td><?= h($jobs->enddate) ?></td>
                <td><?= h($jobs->datedesc_id) ?></td>
                <td><?= h($jobs->company_id) ?></td>
                <td><?= h($jobs->industry_id) ?></td>
                <td><?= h($jobs->subindustry_id) ?></td>
                <td><?= h($jobs->city) ?></td>
                <td><?= h($jobs->state_id) ?></td>
                <td><?= h($jobs->country_id) ?></td>
                <td><?= h($jobs->reference) ?></td>
                <td><?= h($jobs->twittercount) ?></td>
                <td><?= h($jobs->created) ?></td>
                <td><?= h($jobs->modified) ?></td>
                <td><?= h($jobs->display_date) ?></td>
                <td><?= h($jobs->display_salary) ?></td>
                <td><?= h($jobs->display_state) ?></td>
                <td><?= h($jobs->display_country) ?></td>
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
</div>
</div>