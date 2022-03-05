
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userQualification) ?>
    <fieldset>
        <legend><?= __('Add User Qualification') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Name of Qualification']);
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('country_id', ['options' => $countries, 'class'=>'form-control', 'label' => false, 'placeholder'=>'country_id']);
            echo $this->Form->input('type_of_qualification', ['class'=>'form-control', 'label' => false, 'placeholder'=>'type_of_qualification']);
            echo $this->Form->input('institution', ['class'=>'form-control', 'label' => false, 'placeholder'=>'institution']);
            echo $this->Form->input('from_date', ['empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('to_date', ['empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('field', ['class'=>'form-control', 'label' => false, 'placeholder'=>'field']);
            echo $this->Form->input('description', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Description']);
            echo $this->Form->input('rank', ['class'=>'form-control', 'label' => false, 'placeholder'=>'rank']);
            echo $this->Form->input('displayme', ['class'=>'form-control', 'label' => false, 'placeholder'=>'displayme']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>