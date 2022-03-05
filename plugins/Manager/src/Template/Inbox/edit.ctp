<div class="row">
	<div class="col-md-12">

<BR>
    <?= $this->Form->create($contactHistory) ?>
    <fieldset>
        <legend><?= __('Edit Contact History') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Name']);
            echo $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Email']);
            echo $this->Form->input('tel', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Tel']);
            echo $this->Form->input('message', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Message']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactHistory->id), 'class' => 'btn btn-danger'] );  ?>
</div>
