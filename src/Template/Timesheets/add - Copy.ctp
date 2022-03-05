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
        <span class="large-legend">Create Timesheet</span>
        <BR><BR>
   </div>

	<div class="col-md-12">
    <?php echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'name']); ?>
    <BR><BR>
  </div>  
  <div class="col-md-4 col-xs-6">
       <?php      
            $stime = array();
            $stime[9] = '9am';
            $stime[8] = '8am';
            $stime[7] = '7am'; 
            $stime[6] = '6am';  
            $stime[5] = '5am'; 
            $stime[4] = '4am'; 
            $stime[3] = '3am'; 
            $stime[2] = '2am'; 
            $stime[1] = '1am';                                                                        
            $stime[24] = '12pm midnight';
            $stime[23] = '11pm';
            $stime[22] = '10pm'; 
            $stime[21] = '9pm';  
            $stime[20] = '8pm'; 
            $stime[19] = '7pm'; 
            $stime[18] = '6pm'; 
            $stime[17] = '5pm'; 
            $stime[16] = '4pm';   
            $stime[15] = '3pm';
            $stime[14] = '2pm'; 
            $stime[13] = '1pm';  
            $stime[12] = '12am'; 
            $stime[11] = '11am'; 
            $stime[10] = '10am'; 
            
          echo $this->Form->input('stime', ['options' => $stime, 'class'=>'form-control', 'label' => 'Starting Time', 'style' => 'width:100px;']); 

?>
  </div>        
  <div class="col-md-4 col-xs-6"> 
  <?php                                     
            
            $ftime = array();
            $ftime[17] = '5pm'; 
            $ftime[16] = '4pm';   
            $ftime[15] = '3pm';
            $ftime[14] = '2pm'; 
            $ftime[13] = '1pm';  
            $ftime[12] = '12am'; 
            $ftime[11] = '11am'; 
            $ftime[10] = '10am'; 
            $ftime[9] = '9am';
            $ftime[8] = '8am';
            $ftime[7] = '7am'; 
            $ftime[6] = '6am';  
            $ftime[5] = '5am'; 
            $ftime[4] = '4am'; 
            $ftime[3] = '3am'; 
            $ftime[2] = '2am'; 
            $ftime[1] = '1am';                                                                        
            $ftime[24] = '12pm midnight';
            $ftime[23] = '11pm';
            $ftime[22] = '10pm'; 
            $ftime[21] = '9pm';  
            $ftime[20] = '8pm'; 
            $ftime[19] = '7pm'; 
            $ftime[18] = '6pm'; 
                                                                       
                                                                       
            echo $this->Form->input('ftime', ['options' => $ftime, 'class'=>'form-control', 'label' => 'Finish Time', 'style' => 'width:100px;']);
      ?>
    </div>            
  <div class="col-md-4 col-xs-6">
  <?php            
          
            $sminutes = array();
            $sminutes[0] = '0';
            $sminutes[5] = '5 miniutes';
            $sminutes[10] = '10 miniutes'; 
            $sminutes[15] = '15 miniutes'; 
            $sminutes[20] = '20 miniutes';  
            $sminutes[25] = '25 miniutes';  
            $sminutes[30] = '30 miniutes';  
            $sminutes[35] = '35 miniutes'; 
            $sminutes[40] = '40 miniutes';  
            $sminutes[45] = '45 miniutes'; 
            $sminutes[50] = '50 miniutes';  
            $sminutes[55] = '55 miniutes'; 
            $sminutes[60] = '60 miniutes';    
            
            echo $this->Form->input('break', ['options' => $sminutes, 'label'=>'Lunch break in minutes', 'class'=>'form-control', 'style' => 'width:100px;']);
?>
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