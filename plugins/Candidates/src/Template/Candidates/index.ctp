
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Candidate'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Candidates') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('candidate_status_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('candidate_rating_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('candidate_source_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('available_from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('current_company') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jobtype_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contactmethod_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('current_position') ?></th>
                <th scope="col"><?= $this->Paginator->sort('current_salary') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ideal_position') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ideal_location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ideal_salary') ?></th>
                <th scope="col"><?= $this->Paginator->sort('linkedin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('facebook') ?></th>
                <th scope="col"><?= $this->Paginator->sort('googleplus') ?></th>
                <th scope="col"><?= $this->Paginator->sort('twitter') ?></th>
                <th scope="col"><?= $this->Paginator->sort('website') ?></th>
                <th scope="col"><?= $this->Paginator->sort('summary') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidates as $candidate): ?>
            <tr>
                <td><?= $this->Number->format($candidate->id) ?></td>
                <td><?= $candidate->has('user') ? $this->Html->link($candidate->user->name, ['controller' => 'Users', 'action' => 'view', $candidate->user->id]) : '' ?></td>
                <td><?= $candidate->has('candidate_status') ? $this->Html->link($candidate->candidate_status->id, ['controller' => 'CandidateStatuses', 'action' => 'view', $candidate->candidate_status->id]) : '' ?></td>
                <td><?= $candidate->has('candidate_rating') ? $this->Html->link($candidate->candidate_rating->id, ['controller' => 'CandidateRatings', 'action' => 'view', $candidate->candidate_rating->id]) : '' ?></td>
                <td><?= $candidate->has('candidate_source') ? $this->Html->link($candidate->candidate_source->id, ['controller' => 'CandidateSources', 'action' => 'view', $candidate->candidate_source->id]) : '' ?></td>
                <td><?= h($candidate->available_from) ?></td>
                <td><?= $candidate->has('company') ? $this->Html->link($candidate->company->name, ['controller' => 'Companies', 'action' => 'view', $candidate->company->id]) : '' ?></td>
                <td><?= h($candidate->current_company) ?></td>
                <td><?= $candidate->has('jobtype') ? $this->Html->link($candidate->jobtype->name, ['controller' => 'Jobtypes', 'action' => 'view', $candidate->jobtype->id]) : '' ?></td>
                <td><?= $candidate->has('contactmethod') ? $this->Html->link($candidate->contactmethod->name, ['controller' => 'Contactmethods', 'action' => 'view', $candidate->contactmethod->id]) : '' ?></td>
                <td><?= h($candidate->current_position) ?></td>
                <td><?= h($candidate->current_salary) ?></td>
                <td><?= h($candidate->ideal_position) ?></td>
                <td><?= h($candidate->ideal_location) ?></td>
                <td><?= h($candidate->ideal_salary) ?></td>
                <td><?= h($candidate->linkedin) ?></td>
                <td><?= h($candidate->facebook) ?></td>
                <td><?= h($candidate->googleplus) ?></td>
                <td><?= h($candidate->twitter) ?></td>
                <td><?= h($candidate->website) ?></td>
                <td><?= h($candidate->summary) ?></td>
                <td><?= h($candidate->created) ?></td>
                <td><?= h($candidate->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $candidate->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidate->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidate->id), 'class' => 'btn btn-danger btn-xs']) ?>
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