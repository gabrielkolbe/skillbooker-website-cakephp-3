<div class="col-md-6 col-md-offset-3">
<div class="contentbox">
<h2>Create a New Password</h2>                       
<BR>
<?= $this->Form->create() ?>
<?= $this->Form->input('firstpassword', ['type'=>'password', 'class'=>'form-control', 'label' => false, 'placeholder'=>"Password"]) ?>
<?= $this->Form->input('confirmpassword', ['type'=>'password', 'class'=>'form-control', 'label' => false, 'placeholder'=>"Confirm Password"]) ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>

<?= $this->Form->end() ?>
<BR><BR>
</div>
</div>