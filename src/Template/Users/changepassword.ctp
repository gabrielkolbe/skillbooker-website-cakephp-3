<?= $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'users','action' => 'changepasswordaction']]) ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
<h1>Create a new password</h1>
<p>Your password will be changed</p>    
    <fieldset>
    <?php echo '<span id="message"></span>'; ?>
        <?= $this->Form->input('firstpassword', ['type'=>'password', 'class'=>'form-control', 'label' => false, 'placeholder'=>"New Password", 'required' => true]) ?>
        <?= $this->Form->input('confirmpassword', ['type'=>'password', 'class'=>'form-control', 'label' => false, 'placeholder'=>"Confirm New Password", 'required' => true]) ?>
    </fieldset>
<?= $this->Form->end() ?>
<script>
$('#firstpassword, #confirmpassword').on('keyup', function () {
  if ($('#firstpassword').val() == $('#confirmpassword').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
</script>