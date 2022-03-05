<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>

<div class="row">
<div class="col-md-12">
<div class="contentbox">
  <h2><?= __('Post a New Job') ?></h2>
  <?= $this->Form->create($job, ['id' => 'addjob']) ?>
      <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
      <BR>
<div class="row quick">
	<div class="col-md-6">
  <BR>
        <?php
            echo $this->Form->input('title', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Job Title']);
            echo $this->Form->input('city', ['class'=>'form-control', 'label' => false, 'placeholder'=>'In which city/location']);
            echo $this->Form->input('country_id', ['options' => $countries, 'label' => false, 'empty' => 'Select Country >>', 'class'=>'form-control', 'default'=>DEFAULT_COUNTRYID]);
            echo $this->Form->input('display_date', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Date Display']);
            echo $this->Form->input('display_salary', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Salary Display']);
     ?>
    </div>
    <div class="col-md-6">
    <BR>
        <?php
            echo $this->Form->input('jobtype_id', ['options' => $jobtypes, 'empty' => 'Select Type >>', 'label' => false, 'class'=>'form-control']);
            echo $this->Form->input('industry_id', ['options' => $industries, 'empty' => 'Select A Industry >>', 'label' => false, 'class'=>'form-control', 'default'=>DEFAULT_INDUSTRYID]);    
            echo $this->Form->input('recruiter_name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Recruiter Name']);
            echo $this->Form->input('recruiter_email', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Recruiter Email']);
            echo $this->Form->input('recruiter_id', ['options' => $recruiterslist, 'label' => false, 'empty' => 'Select Recruiter >>', 'class'=>'form-control']);
        ?>
        <input type="checkbox" name="uselist" value="1"> Use drop down list<br>
    </div>
</div>
  <BR>
<div class="row">
  <div class="col-md-12">
  			<?php echo $this->Form->textarea('description',['class'=>'validate[blockscript] ckeditor']); ?>
  </div>
</div>

<div class="row">
<div class="col-md-12">
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
</div>

</div>
</div>
</div>