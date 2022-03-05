
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($userPublication) ?>
    <fieldset>
        <legend><?= __('Edit User Publication') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']);
            echo $this->Form->input('publisher', ['class'=>'form-control', 'label' => false, 'placeholder'=>'publisher']);
            echo $this->Form->input('summary', ['class'=>'form-control', 'label' => false, 'placeholder'=>'summary']);
            echo $this->Form->input('publishdate', ['class'=>'form-control', 'label' => false, 'placeholder'=>'publishdate']);
            echo $this->Form->input('rank', ['class'=>'form-control', 'label' => false, 'placeholder'=>'rank']);
            echo $this->Form->input('displayme', ['class'=>'form-control', 'label' => false, 'placeholder'=>'displayme']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>