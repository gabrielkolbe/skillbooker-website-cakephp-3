
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($emailLog) ?>
    <fieldset>
        <legend><?= __('Add Email Log') ?></legend>
        <?php
            echo $this->Form->input('receiver', ['class'=>'form-control', 'label' => false, 'placeholder'=>'receiver']);
            echo $this->Form->input('receiver_email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'receiver_email']);
            echo $this->Form->input('sender', ['class'=>'form-control', 'label' => false, 'placeholder'=>'sender']);
            echo $this->Form->input('sender_email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'sender_email']);
            echo $this->Form->input('email_template_id', ['options' => $emailTemplates, 'class'=>'form-control', 'label' => false, 'placeholder'=>'email_template_id']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>