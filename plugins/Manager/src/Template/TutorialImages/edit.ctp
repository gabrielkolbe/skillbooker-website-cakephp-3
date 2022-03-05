
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($tutorialImage) ?>
    <fieldset>
        <legend><?= __('Edit Tutorial Image') ?></legend>
        <?php
            echo $this->Form->input('tutorial_id', ['options' => $tutorials, 'class'=>'form-control', 'label' => false, 'placeholder'=>'tutorial_id']);
            echo $this->Form->input('location', ['class'=>'form-control', 'label' => false, 'placeholder'=>'location']);
            echo $this->Form->input('photo', ['class'=>'form-control', 'label' => false, 'placeholder'=>'photo']);
            echo $this->Form->input('alttag', ['class'=>'form-control', 'label' => false, 'placeholder'=>'alttag']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>