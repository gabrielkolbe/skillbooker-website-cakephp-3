
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($candidate) ?>
    <fieldset>
        <legend><?= __('Add Candidate') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('candidate_status_id', ['options' => $candidateStatuses, 'class'=>'form-control', 'label' => false, 'placeholder'=>'candidate_status_id']);
            echo $this->Form->input('candidate_rating_id', ['options' => $candidateRatings, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('candidate_source_id', ['options' => $candidateSources, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('available_from', ['empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('company_id', ['options' => $companies, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('current_company', ['class'=>'form-control', 'label' => false, 'placeholder'=>'current_company']);
            echo $this->Form->input('jobtype_id', ['options' => $jobtypes, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('contactmethod_id', ['options' => $contactmethods, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('current_position', ['class'=>'form-control', 'label' => false, 'placeholder'=>'current_position']);
            echo $this->Form->input('current_salary', ['class'=>'form-control', 'label' => false, 'placeholder'=>'current_salary']);
            echo $this->Form->input('ideal_position', ['class'=>'form-control', 'label' => false, 'placeholder'=>'ideal_position']);
            echo $this->Form->input('ideal_location', ['class'=>'form-control', 'label' => false, 'placeholder'=>'ideal_location']);
            echo $this->Form->input('ideal_salary', ['class'=>'form-control', 'label' => false, 'placeholder'=>'ideal_salary']);
            echo $this->Form->input('linkedin', ['class'=>'form-control', 'label' => false, 'placeholder'=>'linkedin']);
            echo $this->Form->input('facebook', ['class'=>'form-control', 'label' => false, 'placeholder'=>'facebook']);
            echo $this->Form->input('googleplus', ['class'=>'form-control', 'label' => false, 'placeholder'=>'googleplus']);
            echo $this->Form->input('twitter', ['class'=>'form-control', 'label' => false, 'placeholder'=>'twitter']);
            echo $this->Form->input('website', ['class'=>'form-control', 'label' => false, 'placeholder'=>'website']);
            echo $this->Form->input('summary', ['class'=>'form-control', 'label' => false, 'placeholder'=>'summary']);
            echo $this->Form->input('notes', ['class'=>'form-control', 'label' => false, 'placeholder'=>'notes']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>