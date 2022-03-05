<div class="col-md-6 col-md-offset-3">
<div class="contentbox">
<h2>Verify Your Account</h2>
<p>Please supply the following information</p><BR>
    <?= $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'users','action' => 'verify', $string], 'type' => 'file']) ?> 

        <?php
            echo $this->Form->input('firstpassword', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Set password']);
            echo $this->Form->input('confirmpassword', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Retype password']);
            echo $this->Form->input('country_id', ['options' => $countries, 'class'=>'form-control', 'label' => false, 'default' => DEFAULT_COUNTRYID]);
            echo $this->Form->input('industry_id', ['options' => $industries, 'class'=>'form-control', 'label' => false, 'default' => DEFAULT_INDUSTRYID]);
            ?>
          
            <BR><BR>
      <?php
            echo $this->Form->input('avatar', ['class'=>'form-control', 'label' => 'Profile Avatar', 'type' => 'file']);
        ?>
        <small>Avatar will be cropped square. (GIF, JPG or PNG; limit 10MB)</small>

    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    <BR><BR><BR>
  </div>
</div>