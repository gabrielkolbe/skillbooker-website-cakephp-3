<script type="text/javascript">
$(document).ready(function(){
            
    $('#country-id').change(function(){     
    $.ajax({
         type : "POST",
                url  : ('/manager/states/populate/') + $("#country-id option:selected").val(),
                success : function(opt){
                        document.getElementById('state-id').innerHTML = opt;   
                    }
            })
            });
                     

});

</script>
<div class="row">
	<div class="col-md-12">
    <?= $this->Form->create($company) ?>
    <fieldset>
        <legend><?= __('Edit Company') ?></legend>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Company Name']);
            echo $this->Form->input('firstname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'firstname']);
            echo $this->Form->input('lastname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'lastname']);
            echo $this->Form->input('contact', ['class'=>'form-control', 'label' => false, 'placeholder'=>'contact']);
            echo $this->Form->input('position', ['class'=>'form-control', 'label' => false, 'placeholder'=>'position']);
            echo $this->Form->input('reportto', ['class'=>'form-control', 'label' => false, 'placeholder'=>'reportto']);
            echo $this->Form->input('contactmethod_id', ['class'=>'form-control', 'label' => false, 'placeholder'=>'contactmethod_id']);
            echo $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'email']);
            echo $this->Form->input('landline', ['class'=>'form-control', 'label' => false, 'placeholder'=>'landline']);
            echo $this->Form->input('mobile', ['class'=>'form-control', 'label' => false, 'placeholder'=>'mobile']);
            echo $this->Form->input('address', ['class'=>'form-control', 'label' => false, 'placeholder'=>'address']);
            echo $this->Form->input('country_id', ['options' => $countries, 'label' => false, 'empty' => 'Select Country >>', 'class'=>'form-control']);
            echo '<select name="state_id" class="form-control state-id" id="state-id"><option value="'.$company['state_id'].'">'.$company['display_state'].' - edit by reselecting Country</option> </select>';
            echo $this->Form->input('town', ['class'=>'form-control', 'label' => false, 'placeholder'=>'town']);
            echo $this->Form->input('postcode', ['class'=>'form-control', 'label' => false, 'placeholder'=>'postcode']);
            echo $this->Form->input('notes', ['class'=>'form-control', 'label' => false, 'placeholder'=>'notes']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>