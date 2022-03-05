<div class="row">
	<div class="col-md-12">
    <legend><?= h($candidate->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $candidate->has('user') ? $this->Html->link($candidate->user->name, ['controller' => 'Users', 'action' => 'view', $candidate->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Candidate Status') ?></th>
            <td><?= $candidate->has('candidate_status') ? $this->Html->link($candidate->candidate_status->id, ['controller' => 'CandidateStatuses', 'action' => 'view', $candidate->candidate_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Candidate Rating') ?></th>
            <td><?= $candidate->has('candidate_rating') ? $this->Html->link($candidate->candidate_rating->id, ['controller' => 'CandidateRatings', 'action' => 'view', $candidate->candidate_rating->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Candidate Source') ?></th>
            <td><?= $candidate->has('candidate_source') ? $this->Html->link($candidate->candidate_source->id, ['controller' => 'CandidateSources', 'action' => 'view', $candidate->candidate_source->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $candidate->has('company') ? $this->Html->link($candidate->company->name, ['controller' => 'Companies', 'action' => 'view', $candidate->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Company') ?></th>
            <td><?= h($candidate->current_company) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jobtype') ?></th>
            <td><?= $candidate->has('jobtype') ? $this->Html->link($candidate->jobtype->name, ['controller' => 'Jobtypes', 'action' => 'view', $candidate->jobtype->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contactmethod') ?></th>
            <td><?= $candidate->has('contactmethod') ? $this->Html->link($candidate->contactmethod->name, ['controller' => 'Contactmethods', 'action' => 'view', $candidate->contactmethod->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Position') ?></th>
            <td><?= h($candidate->current_position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Salary') ?></th>
            <td><?= h($candidate->current_salary) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ideal Position') ?></th>
            <td><?= h($candidate->ideal_position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ideal Location') ?></th>
            <td><?= h($candidate->ideal_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ideal Salary') ?></th>
            <td><?= h($candidate->ideal_salary) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Linkedin') ?></th>
            <td><?= h($candidate->linkedin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Facebook') ?></th>
            <td><?= h($candidate->facebook) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Googleplus') ?></th>
            <td><?= h($candidate->googleplus) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Twitter') ?></th>
            <td><?= h($candidate->twitter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website') ?></th>
            <td><?= h($candidate->website) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Summary') ?></th>
            <td><?= h($candidate->summary) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($candidate->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Available From') ?></th>
            <td><?= h($candidate->available_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($candidate->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($candidate->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($candidate->notes)); ?>
    </div>
</div>
</div>