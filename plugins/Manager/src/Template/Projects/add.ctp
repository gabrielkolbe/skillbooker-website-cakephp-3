
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($project) ?>
    <fieldset>
        <legend><?= __('Add Project') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'slug']);
            echo $this->Form->input('industry_id', ['options' => $industries, 'class'=>'form-control', 'label' => false, 'placeholder'=>'industry_id']);
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('awardeduser', ['class'=>'form-control', 'label' => false, 'placeholder'=>'awardeduser']);
            echo $this->Form->input('projecttype', ['class'=>'form-control', 'label' => false, 'placeholder'=>'projecttype']);
            echo $this->Form->input('currency_id', ['options' => $currencies, 'empty' => true, 'class'=>'form-control']);
            echo $this->Form->input('denomination', ['class'=>'form-control', 'label' => false, 'placeholder'=>'denomination']);
            echo $this->Form->input('currency_abbrev', ['class'=>'form-control', 'label' => false, 'placeholder'=>'currency_abbrev']);
            echo $this->Form->input('amount', ['class'=>'form-control', 'label' => false, 'placeholder'=>'amount']);
            echo $this->Form->input('stage1', ['class'=>'form-control', 'label' => false, 'placeholder'=>'stage1']);
            echo $this->Form->input('stage2', ['class'=>'form-control', 'label' => false, 'placeholder'=>'stage2']);
            echo $this->Form->input('stage3', ['class'=>'form-control', 'label' => false, 'placeholder'=>'stage3']);
            echo $this->Form->input('stage4', ['class'=>'form-control', 'label' => false, 'placeholder'=>'stage4']);
            echo $this->Form->input('short_description', ['class'=>'form-control', 'label' => false, 'placeholder'=>'short_description']);
            echo $this->Form->input('twittercount', ['class'=>'form-control', 'label' => false, 'placeholder'=>'twittercount']);
            echo $this->Form->input('status', ['class'=>'form-control', 'label' => false, 'placeholder'=>'status']);
            echo $this->Form->input('bids', ['class'=>'form-control', 'label' => false, 'placeholder'=>'bids']);
            echo $this->Form->input('skills', ['class'=>'form-control', 'label' => false, 'placeholder'=>'skills']);
            echo $this->Form->input('date_human', ['class'=>'form-control', 'label' => false, 'placeholder'=>'date_human']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>