<?php $this->Html->css('bootstrap-datepicker.min'); ?>
<?php $this->Html->script('bootstrap-datepicker.min'); ?>
<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>

<script>
$(function() {
  $("input#startdate").datepicker({
        format: 'yyyy-mm-dd'
    });
  $("input#enddate").datepicker({
        format: 'yyyy-mm-dd'
    });
});

</script>

<div class="row">
<div class="col-md-12">
<div class="contentbox">
  <h2><?= __('Edit this Job') ?></h2>
  <?= $this->Form->create($job, ['id' => 'addjob']) ?>
        <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
<div class="row quick">
	<div class="col-md-6">
  <BR>
        <?php
            echo $this->Form->input('title', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Job Title', 'required' => true]);

            echo $this->Form->input('city', ['class'=>'form-control', 'label' => false, 'placeholder'=>'In which city/location', 'required' => true]);
            echo $this->Form->input('country_id', ['options' => $countries, 'label' => false, 'empty' => 'Select Country >>', 'class'=>'form-control', 'default'=>DEFAULT_COUNTRYID, 'required' => true]);
            echo '<BR><strong>Salary Options</strong>';
            
            if($job->salaryoption == 1) { $one = 'checked'; $two = ''; } else {  $one = ''; $two = 'checked'; }
            
            echo '<div class="salaryprice"><span id="changesalary" class="fa fa-chevron-circle-down">&nbsp;</span> <input type="radio" name="salaryoption" id="salaryoption" value="1" '.$one.' required > Set to display Salary Amounts ';
            echo $this->Form->input('currency_id', ['options' => $currencies, 'empty' => 'Select Currency >>', 'label' => false, 'class'=>'form-control']);
            echo $this->Form->input('min_salary', ['class'=>'form-control', 'label' => false, 'placeholder'=>'min salary (just numbers, no commas or dots)']);
            echo $this->Form->input('max_salary', ['class'=>'form-control', 'label' => false, 'placeholder'=>'max salary (just numbers, no commas or dots)']);
            echo $this->Form->input('paymentinterval_id', ['options' => $paymentintervals, 'empty' => 'Select Period >>', 'label' => false, 'class'=>'form-control']);
            echo '</div><div class="salarydesc"><span id="changesalaryback" class="fa fa-chevron-circle-up">&nbsp;</span> <input type="radio" name="salaryoption" id="salaryoption"  value="2" '.$two.' required > Set to display Salary Description ';
            echo $this->Form->input('salarydesc_id', ['options' => $salarydescs, 'empty' => 'Alternative Salary Description >>', 'label' => false, 'class'=>'form-control']);
            echo '</div>';


     ?>
    </div>
    <div class="col-md-6">
        <?php
            echo '<strong>Date Options</strong>';
            
            if($job->dateoption == 1) { $one = 'checked'; $two = ''; } else {  $one = ''; $two = 'checked'; }
            
            echo '<div class="datecal"><span id="changedate" class="fa fa-chevron-circle-down">&nbsp;</span><input type="radio" name="dateoption" id="dateoption"  value="1" '.$one.' required > Set to display Start and/or End date ';
            echo $this->Form->input('startdate', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'Start Date (yyyy-mm-dd)']);	
            echo $this->Form->input('enddate', ['type' => 'text', 'empty' => true, 'label' => false, 'class'=>'form-control', 'placeholder'=>'End Date (yyyy-mm-dd)']);
            echo ' </div><div class="datedesc"><span id="changedateback" class="fa fa-chevron-circle-up">&nbsp;</span><input type="radio" name="dateoption" id="dateoption"  value="2" '.$two.' required > Set to display Date Description';
            echo $this->Form->input('datedesc_id', ['options' => $datedescs, 'empty' => 'Alternative Date Description >>', 'label' => false, 'class'=>'form-control']);
            echo '</div><BR>';
            echo $this->Form->input('jobtype_id', ['options' => $jobtypes, 'empty' => 'Select Type >>', 'label' => false, 'class'=>'form-control', 'required' => true]);
            echo $this->Form->input('industry_id', ['options' => $industries, 'empty' => 'Select A Industry >>', 'label' => false, 'class'=>'form-control', 'default'=>DEFAULT_INDUSTRYID, 'required' => true]);      

        ?>
    </div>
</div>
  <BR>
<div class="row">
  <div class="col-md-12">
  			<?php echo $this->Form->textarea('description',['class'=>'validate[blockscript] ckeditor', 'required' => true]); ?>
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
<script>

<?php  if($job->salaryoption == 1) { ?> $('.salarydesc').hide(); <?php  } else { ?> $('.salaryprice').hide(); <?php } ?>
<?php  if($job->dateoption == 1) { ?> $('.datedesc').hide(); <?php  } else { ?> $('.datecal').hide(); <?php } ?>

$("#changedate").click(function() {
   $('.datecal').hide("slow");
   $('.datedesc').show("slow");
});

$("#changedateback").click(function() {
   $('.datecal').show("slow");
   $('.datedesc').hide("slow");
});

$("#changesalary").click(function() {
   $('.salaryprice').hide("slow");
   $('.salarydesc').show("slow");
});

$("#changesalaryback").click(function() {
   $('.salaryprice').show("slow");
   $('.salarydesc').hide("slow");
});

</script>

<script type="text/javascript">
$(document).ready(function(){

$('.salarydesc').hide();
$('.datedesc').hide();

</script>
