<?= $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'users','action' => 'changeslugaction']]) ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right', 'id'=>'submit']) ?>
<h2>Change your online resume / CV slug</h2>
<BR>  
 You current slug is <strong><?php echo $this->request->session()->read('Auth.User.slug'); ?></strong><BR>
 Only characters <strong>(1-9, a-z, '_', and '-')</strong> are allowed<BR><BR>
        <?php echo '<span id="message"></span>'; ?>
        <?= $this->Form->input('slug', ['class'=>'form-control', 'label' => false, 'placeholder'=>"New slug", 'required' => true]) ?>
        <?= $this->Form->input('confirmslug', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Confirm new slug", 'required' => true]) ?>
 
<?= $this->Form->end() ?>
<script>

$('#slug, #confirmslug').on('keyup', function () {
  if ($('#slug').val() == $('#confirmslug').val()) {
    
    var slug = $('#slug').val();
    var regex = new RegExp('^[A-Za-z0-9\-\_]+$');
    if(regex.test(slug)) {
        $('#message').html('Matching').css('color', 'green');
    } else {
     $('#message').html('Illegal characters').css('color', 'red');
     //$("#submit").hide();
    }
    
    
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
</script>