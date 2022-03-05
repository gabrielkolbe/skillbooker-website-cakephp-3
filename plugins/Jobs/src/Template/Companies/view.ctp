<div class="row">
	<div class="col-md-12">
    <legend><?= h($company->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Contact') ?></th>
            <td><?= h($company->contact) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= h($company->position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reportto') ?></th>
            <td><?= h($company->reportto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($company->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landline') ?></th>
            <td><?= h($company->landline) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($company->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($company->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $company->has('state') ? $this->Html->link($company->state->name, ['controller' => 'States', 'action' => 'view', $company->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Town') ?></th>
            <td><?= h($company->town) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postcode') ?></th>
            <td><?= h($company->postcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contactmethod Id') ?></th>
            <td><?= $this->Number->format($company->contactmethod_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($company->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($company->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($company->notes)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Companies') ?></h4>
        <?php if (!empty($company->companies)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Company') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Contact') ?></th>
                <th scope="col"><?= __('Position') ?></th>
                <th scope="col"><?= __('Imported Company') ?></th>
                <th scope="col"><?= __('Reportto') ?></th>
                <th scope="col"><?= __('Contactmethod Id') ?></th>
                <th scope="col"><?= __('Contactcategory Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Landline') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Town') ?></th>
                <th scope="col"><?= __('Postcode') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->companies as $companies): ?>
            <tr>
                <td><?= h($companies->id) ?></td>
                <td><?= h($companies->company) ?></td>
                <td><?= h($companies->firstname) ?></td>
                <td><?= h($companies->lastname) ?></td>
                <td><?= h($companies->contact) ?></td>
                <td><?= h($companies->position) ?></td>
                <td><?= h($companies->imported_company) ?></td>
                <td><?= h($companies->reportto) ?></td>
                <td><?= h($companies->contactmethod_id) ?></td>
                <td><?= h($companies->contactcategory_id) ?></td>
                <td><?= h($companies->company_id) ?></td>
                <td><?= h($companies->email) ?></td>
                <td><?= h($companies->landline) ?></td>
                <td><?= h($companies->mobile) ?></td>
                <td><?= h($companies->address) ?></td>
                <td><?= h($companies->state_id) ?></td>
                <td><?= h($companies->town) ?></td>
                <td><?= h($companies->postcode) ?></td>
                <td><?= h($companies->notes) ?></td>
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
    <div class="related">
        <h4><?= __('Related Jobs') ?></h4>
        <?php if (!empty($company->jobs)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Jobtype Id') ?></th>
                <th scope="col"><?= __('Jobstatus Id') ?></th>
                <th scope="col"><?= __('Jobsalarytype Id') ?></th>
                <th scope="col"><?= __('Jobsource Id') ?></th>
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
            <?php foreach ($company->jobs as $jobs): ?>
            <tr>
                <td><?= h($jobs->id) ?></td>
                <td><?= h($jobs->title) ?></td>
                <td><?= h($jobs->user_id) ?></td>
                <td><?= h($jobs->jobtype_id) ?></td>
                <td><?= h($jobs->jobstatus_id) ?></td>
                <td><?= h($jobs->jobsalarytype_id) ?></td>
                <td><?= h($jobs->jobsource_id) ?></td>
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
</div>
</div>