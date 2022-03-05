
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($messenger) ?>
    <fieldset>
        <legend><?= __('Add Messenger') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'class'=>'form-control', 'label' => false, 'placeholder'=>'user_id']);
            echo $this->Form->input('direction', ['class'=>'form-control', 'label' => false, 'placeholder'=>'direction']);
            echo $this->Form->input('sender_id', ['class'=>'form-control', 'label' => false, 'placeholder'=>'sender_id']);
            echo $this->Form->input('sender_email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'sender_email']);
            echo $this->Form->input('receiver_id', ['class'=>'form-control', 'label' => false, 'placeholder'=>'receiver_id']);
            echo $this->Form->input('receiver_email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'receiver_email']);
            echo $this->Form->input('title', ['class'=>'form-control', 'label' => false, 'placeholder'=>'title']);
            echo $this->Form->input('message', ['class'=>'form-control', 'label' => false, 'placeholder'=>'message']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>