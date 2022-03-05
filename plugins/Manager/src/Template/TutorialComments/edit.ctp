
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($tutorialComment) ?>
    <fieldset>
        <legend><?= __('Edit Tutorial Comment') ?></legend>
        <?php
            echo $this->Form->input('is_parent', ['class'=>'form-control', 'label' => false, 'placeholder'=>'is_parent']);
            echo $this->Form->input('is_child', ['class'=>'form-control', 'label' => false, 'placeholder'=>'is_child']);
            echo $this->Form->input('parent_id', ['options' => $parentTutorialComments, 'class'=>'form-control', 'label' => false, 'placeholder'=>'parent_id']);
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('comment', ['class'=>'form-control', 'label' => false, 'placeholder'=>'comment']);
            echo $this->Form->input('approved', ['class'=>'form-control', 'label' => false, 'placeholder'=>'approved']);
            echo $this->Form->input('tutorial_id', ['options' => $tutorials, 'class'=>'form-control', 'label' => false, 'placeholder'=>'tutorial_id']);
            echo $this->Form->input('username', ['class'=>'form-control', 'label' => false, 'placeholder'=>'username']);
            echo $this->Form->input('userslug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'userslug']);
            echo $this->Form->input('useravatar', ['class'=>'form-control', 'label' => false, 'placeholder'=>'useravatar']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>