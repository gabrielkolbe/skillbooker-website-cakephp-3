<div class="row">
	<div class="col-md-12">
<H1>Users</H1>  
     <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
          <small>Email verification will be send out to request user to create a password</small> <BR>
          <small>Also: All the fields you leave empty, will be asked again on verification of email</small>
          <BR><BR>
        <?php
            echo $this->Form->input('verified', ['type'=>'checkbox', 'class'=>'', 'label' => ' Verified?']);
            echo $this->Form->input('status', ['type'=>'checkbox', 'class'=>'', 'label' => ' Approve this user?']);
            echo 'Role<BR>';
            echo $this->Form->input('role_id', ['options' => $roles, 'class'=>'form-control', 'label' => false]);
            echo $this->Form->input('email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'** Email']); 
            echo $this->Form->input('firstname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'First Name']);
            echo $this->Form->input('lastname', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Last Name']);
            echo $this->Form->input('telephone', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Telephone Number']);
            echo $this->Form->input('mobile', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Mobile Number']);            
            echo $this->Form->input('jobtitle', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Job Title']);
            echo $this->Form->input('company', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Company']);
            echo $this->Form->input('country_id', ['options' => $countries, 'class'=>'form-control', 'label' => false, 'default' => DEFAULT_COUNTRYID]);
            echo $this->Form->input('town', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Town']);
            echo $this->Form->input('postcode', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Postcode']);

         ?>
          
            <BR><BR>


    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>