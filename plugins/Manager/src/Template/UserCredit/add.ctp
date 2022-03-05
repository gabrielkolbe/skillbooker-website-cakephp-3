
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userCredit) ?>
    <fieldset>
        <legend><?= __('Add User Credit') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('jobs', ['class'=>'form-control', 'label' => false, 'placeholder'=>'jobs']);
            echo $this->Form->input('subscriptionlevel', ['class'=>'form-control', 'label' => false, 'placeholder'=>'subscriptionlevel']);
            echo $this->Form->input('subscriptiondate', ['empty' => true, 'class'=>'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>