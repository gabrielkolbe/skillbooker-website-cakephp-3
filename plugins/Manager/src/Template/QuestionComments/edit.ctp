
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($questionComment) ?>
    <fieldset>
        <legend><?= __('Edit Question Comment') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('question_id', ['options' => $questions, 'class'=>'form-control', 'label' => false, 'placeholder'=>'question_id']);
            echo $this->Form->input('parent_id', ['class'=>'form-control', 'label' => false, 'placeholder'=>'parent_id']);
            echo $this->Form->input('comment', ['class'=>'form-control', 'label' => false, 'placeholder'=>'comment']);
            echo $this->Form->input('username', ['class'=>'form-control', 'label' => false, 'placeholder'=>'username']);
            echo $this->Form->input('userslug', ['class'=>'form-control', 'label' => false, 'placeholder'=>'userslug']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>