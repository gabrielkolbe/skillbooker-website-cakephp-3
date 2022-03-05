 <?php $this->Html->css('phpcalendar', ['block'=>true]); ?>
<?php $this->Html->script('jquery-ui', ['block'=>true]); ?>
<style>


</style>

<script>
//    var checkbox = $(this).find('td.calender_simple_select input:checkbox');
 // $('table tbody tr td').on('click', function(e){
 //$(document).on('click','.phpcalendar',function(e){
 
$(function(){
$(document).on('click','table tbody tr td',function(e){
    var checkbox = $(this).find('input:checkbox');
    if (!$(e.target).is(':checkbox')) {
        checkbox.attr('checked', !checkbox.is(':checked'));
    }
    $(this).css('background-color', checkbox.is(':checked')?'#ffa500':'#F0F0F0');
});
});
 
</script> 

<script>

$(document).ready(function() {  

  
    $(document).on('click','#showdates',function(){ 
    
    $( "#spinner" ).addClass( "spinner" );
    var theyear = $('#theyear :selected').text();
    var themonth = $('#themonth :selected').val();
      
    $.ajax({
         type : "POST",
                url  : ('/timesheets/getcalendar/'),
                data : {theyear:theyear, themonth:themonth},
                success : function(opt){
                        document.getElementById('calendarhere').innerHTML = opt;
  
                        $( "#spinner" ).removeClass( "spinner" );
                    }
    })
    });
  
  });


</script>

<div class="row">
	<div class="col-md-12">
    <div class="contentbox">
    <?= $this->Form->create($timesheet) ?>

    <fieldset>
    <div class="row">
    <div class="col-md-12">
        <span class="large-legend">Create a day timesheet</span>
        <BR>
   </div>
            
            
	<div class="col-md-12">
  <BR>
  <p>Name will be annexed with 'mm-yyyy-..'</p>
    <?php echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']); ?>
    <BR><BR>
  </div> 
  
    <div class="col-md-12 col-xs-12">
<?php  echo $this->Form->input('employer', ['options' => $employers, 'class'=>'form-control', 'label' => 'Employer']); ?>
  </div> 
   
  <div class="col-md-12 col-xs-12">
<?php  echo $this->Form->input('agent', ['options' => $agents, 'class'=>'form-control', 'label' => 'Agent']); ?>
  </div>        


  
  <div class="col-md-6  col-xs-12">
  <BR>
  <h2>Select year and month</h2>   
     <?php echo $this->Form->input('currentmonth', ['year' => ['id' => 'theyear', 'class' => 'form-control', 'style' => 'width:35%;display:inline-block;margin-right:5px;'], 'month' => ['id' => 'themonth', 'class' => 'form-control', 'style' => 'width:35%;display:inline-block;margin-right:5px;'], 'day' => false,  'label' => false, 'minYear' => date('Y') - 3, 'maxYear' => date('Y') - 0 ]); ?>
     <psan class = "btn btn-primary" id="showdates">Show dates</span>
  </div>
  
    <div class="col-md-6  col-xs-12">   

  </div>  
  
  <div class="col-md-12" id="calendarhere">   

  </div> 
  
</div>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    <BR><BR>
</div>
</div>
</div>