
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($tab) ?>
    <fieldset>
        <legend><?= __('Edit Tab') ?></legend>
        <?php
            $change[1] = 'No';
            $change[2] = 'Yes';
            
            echo $this->Form->input('title', ['class'=>'form-control', 'label' => false, 'placeholder'=>'title']);
            echo $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'the url slug']);
            echo $this->Form->input('urlcontroller', ['options' => $urlcontrollers, 'label' => false, 'empty'=>'Do you know the controller', 'class'=>'form-control']);
            echo $this->Form->input('urlview', ['options' => $urlviews, 'label' => false, 'empty'=>'Do you know the view', 'class'=>'form-control']);
            echo $this->Form->input('changestate', ['options' => $change,  'label'=>'Does it change state on login?',  'empty' => 0, 'class'=>'form-control']);
            echo $this->Form->input('change_title', ['class'=>'form-control',  'label'=>'If it change state what is the new title']);
            echo $this->Form->input('change_slug', ['class'=>'form-control', 'label'=>'If it change state what is the new url']);
            echo $this->Form->input('change_urlcontroller', ['options' => $urlcontrollers, 'label' => false, 'empty'=>'Change: Do you know the controller', 'class'=>'form-control']);
            echo $this->Form->input('change_urlview', ['options' => $urlviews, 'label' => false, 'empty'=>'Change: Do you know the view', 'class'=>'form-control']);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>