<?php $this->Html->css('phpcalendar', ['block'=>true]); ?>
<style>

.hideme {
  display: none;
}

.phpcalendar {
float:right;
}




</style>
<div class="row" style="border: 1px solid #ccc; padding:10px 0px 10px 10px; margin-left:10px;">
    <div class="col-md-12">
    <?php if( $user->id == $this->request->session()->read('Auth.User.id') ) { echo $this->Html->link(__('Edit CV/Resume'), ['plugin' => null, 'controller' => 'portfolio', 'action' => 'index'], ['class' => 'btn btn-primary float-right']); } ?>
   <h1>
      <?PHP if($user->avatar <> ''){ ?>
      <?php echo $this->Html->image('/img/uploads/avatars/'.$user->avatar, array('width'=>'50px', 'margin'=>'5px')); ?>
      <?php } ?>
      <?php echo  $user->firstname.' '.$user->lastname; ?></h1>
      </div>

  <!-- <div class="col-md-6">
  
              <?php echo $this->Html->link('<i class="fa fa-file">&nbsp;</i> PDF <span class="question_invert q_tip2">?</span>',array('plugin' => false, 'controller'=> 'export', 'action'=> 'cv_pdf',),array('class'=>'btn lighterblue','escape'=>false));   ?>
              <?php echo $this->Html->link('<i class="fa fa-file">&nbsp;</i> DOC <span class="question_invert q_tip2">?</span>',array('plugin' => false, 'controller'=> 'export', 'action'=> 'cv_doc',),array('class'=>'btn lighterblue','escape'=>false));   ?>
                <?php if(!empty($user_id)) { ?><span class='btn btn-primary' onclick="message('<?php echo $userdata['Jobseeker']['slug']; ?>');"><i class="fa fa-envelope" aria-hidden="true"></i> MESSAGE <?php echo  $userdata['Jobseeker']['firstname']; ?></SPAN> <?php } else { 
                echo $this->Html->link('<i class="fa fa-envelope" aria-hidden="true"></i> Recruiter Login<BR> to contact</SPAN>',array("plugin"=>false,"controller"=>"users","action" => "login"), array("class" => "btn btn-primary", "escape" => false) );	 } ?>
               
  </div>  -->
</div>
<BR>
<div class="row">
  <div class="col-md-12">
    <div class="contentbox">
      <?php if(!empty($candidate->summary)) { echo $candidate->summary; } ?>
    </div>
  </div>
</div>

<div class="row">

<?php if($candidate->displayme == 1){ 
if( (empty($candidate->ideal_position)) && (empty($candidate->display_jobtype)) && (empty($candidate->ideal_location)) && (empty($candidate->display_contactmethod)) ) { } else { ?>
  <div class="col-md-4">
  <BR>
    <div class="contentbox">
      <strong>Prefered Role:</strong><BR><?php echo $candidate->ideal_position; ?>
      <strong>Prefered Type:</strong> <?php echo $candidate->display_jobtype; ?><BR>
      <strong>Prefered Location:</strong> <?php echo $candidate->ideal_location; ?><BR>
      <strong>Prefered Contact Method:</strong> <?php echo $candidate->display_contactmethod; ?><BR>
    </div>
  </div>
<?php } ?>
    <?php 
    $currentlocation = $user->city.' '.$user->display_state.' '.$user->display_country;
    if( (empty($candidate->available_from)) && (empty($currentlocation)) && (empty($candidate->googleplus)) && (empty($candidate->linkedin)) ) { } else { ?> 
    <div class="col-md-4">
  <BR>
    <div class="contentbox">
      <strong>Currently Location:</strong> <?php echo $currentlocation; ?><BR>
      <strong>Available From:</strong> <?php echo $candidate->available_from; ?><BR>
      <strong>Link to Google Page:</strong> <?php echo $candidate->googleplus; ?><BR>
      <strong>Link to LinkedIn Profile:</strong> <?php echo $candidate->linkedin; ?><BR>
    </div>
  </div>
    <?php } ?>
   <?php if( (empty($candidate->twitter)) && (empty($candidate->facebook)) && (empty($candidate->skype)) && (empty($candidate->website)) ) { } else { ?>
    <div class="col-md-4">
      <BR>
    <div class="contentbox">
       <strong>Link to Twitter:</strong> <?php echo $candidate->twitter; ?><BR>
       <strong>Link to Facebook:</strong> <?php echo $candidate->facebook; ?><BR>
       <strong>Skype Handle:</strong> <?php echo $candidate->skype; ?><BR>
       <strong>Link to own Website/Portfolio:</strong> <?php echo $candidate->website; ?><BR>
    </div>
  </div>
   <?php } ?>
  </div>
<?php } ?>
<BR>
 <h2>
<span class="fa" style="width:50px;"><span class="orangetxt fa-arrow-circle-right rightcalendar " id="calendar"> </span>
<span class="orangetxt fa-arrow-circle-left hideme leftcalendar" id="calendar"> </span></span>
  Calendar</h2>
  <div class="row contentbox hideme" id="showcalendar">   
  <div class="col-md-4">
  <BR>
  <?php echo $calendar1; ?>
  <BR>  
  </div> 
   <div class="col-md-4 text-right">
   <BR>
   <?php echo $user->firstname; ?> is NOT available on <span class='orangetxt'>orange</span> dates<BR>
  <?php echo $calendar2; ?>
  <BR>  
  </div>
      <div class="col-md-4">
    </div>
</div>

<?php if(!empty($skills)){ ?>
  <div class="row">	
    <div class="col-md-12">
     <h2>
<span class="fa" style="width:50px;"><span class="orangetxt fa-arrow-circle-right rightskill " id="skill"> </span>
<span class="orangetxt fa-arrow-circle-left hideme leftskill" id="skill"> </span></span>
  Skills</h2>
      <div class="row contentbox hideme" id="showskill"> 
      <div class="col-md-3">
        <h4>Excellent <img src="/img/5littlestar.png" style="width:84px; height:auto;"></h4>      					         
					<?php foreach($skills as $skill){ 
          if($skill->level == 5) { ?>
          <span class="btn btn-primary btn-xs"><?php echo $skill->skill_name; ?></span>
					<?php } } ?>
     </div>

     
      <div class="col-md-3">
      <h4>Good <img src="/img/4littlestar.png" style="width:84px; height:auto;"></h4>     				         
					<?php foreach($skills as $skill){ 
          if($skill->level == 4) { ?>
          <span class="btn btn-primary btn-xs"><?php echo $skill->skill_name; ?></span>
					<?php } } ?>
     </div>


      <div class="col-md-3">
     	<h4>Average <img src="/img/3littlestar.png" style="width:84px; height:auto;"></h4>     			         
					<?php foreach($skills as $skill){ 
          if($skill->level == 3) { ?>
          <span class="btn btn-primary btn-xs"><?php echo $skill->skill_name; ?></span>
					<?php } } ?>
      </div>  

       <div class="col-md-3">
      	<h4>Basic <img src="/img/2littlestar.png" style="width:84px; height:auto;"></h4>      					         
					<?php foreach($skills as $skill){ 
          if( ($skill->level == 2) || ($skill->level == 1) || ($skill->level == 0) ){ ?>
          <span class="btn btn-primary btn-xs"><?php echo $skill->skill_name; ?></span>
					<?php } } ?>
      </div>        

    </div>
    </div>
  </div>
  <?php } ?>    


  <?php 
$class="one";
$color1="one"; 
$color2="two";
?>

<?php if(!empty($employments)){ ?>
<div class="row"> 
	<div class="col-md-12">
  <h2>
<span class="fa" style="width:50px;"><span class="orangetxt fa-arrow-circle-right rightemployments " id="employments"> </span>
<span class="orangetxt fa-arrow-circle-left hideme leftemployments" id="employments"> </span></span>

  Employment</h2> 
  	<div class="contentbox hideme" id="showemployments">	
					<?php foreach($employments as $employment){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
        <div class="row <?php echo $class; ?>">
            <div class="col-sm-3">
              <strong><?php echo $employment->company; ?></strong><BR>
              <?=$employment->position?><BR>
              <?php if(!empty($employment->from_date)) { echo  $employment->from_date; ?>  - <?php echo $employment->to_date.'<BR>'; } ?>
              <?php echo  $employment->job_location; ?>            
            </div>
            <div class="col-sm-9">
              <h3><?php echo  $employment->position; ?></h3>
              <?php echo $employment->description; ?>
            </div>
        </div>	
					<?php  } ?>
    </div>				
</div>
</div>
<?php } ?>



<?php if(!empty($qualifications)){ ?>
<div class="row"> 
	<div class="col-md-12">
  <h2>
<span class="fa" style="width:50px;"><span class="orangetxt fa-arrow-circle-right rightqualifications " id="qualifications"> </span>
<span class="orangetxt fa-arrow-circle-left hideme leftqualifications" id="qualifications"> </span></span>

  Qualification</h2> 
  	<div class="contentbox hideme" id="showqualifications">	
					<?php foreach($qualifications as $qualification){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
        <div class="row <?php echo $class; ?>">
            <div class="col-sm-3">
              <strong><?php echo $qualification->name; ?></strong><BR>
              <?=$qualification->institution?><BR>
              <?php if(!empty($qualification->from_date)) { echo  $qualification->from_date; ?>  - <?php echo $qualification->to_date.'<BR>'; } ?>
          
            </div>
            <div class="col-sm-9">
              <?php echo $qualification->description; ?>
            </div>
        </div>	
					<?php  } ?>
    </div>				
</div>
</div>
<?php } ?>


<?php if(!empty($publications)){ ?>
<div class="row"> 
	<div class="col-md-12">
  <h2>
<span class="fa" style="width:50px;"><span class="orangetxt fa-arrow-circle-right rightpublications " id="publications"> </span>
<span class="orangetxt fa-arrow-circle-left hideme leftpublications" id="publications"> </span></span>

  Publication</h2> 
  	<div class="contentbox hideme"  id="showpublications">	
					<?php foreach($publications as $publication){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
        <div class="row <?php echo $class; ?>">
            <div class="col-sm-3">
              <strong><?php echo $publication->name; ?></strong><BR>
              <?=$publication->publisher?><BR>
              <?php if(!empty($publication->publishdate)) { echo  $publication->publishdate; } ?>     
            </div>
            <div class="col-sm-9">
              <?php echo $publication->description; ?>
            </div>
        </div>	
					<?php } ?>
    </div>				
</div>
</div>
<?php } ?>


<?php if(!empty($articles)){ ?>
<div class="row"> 
	<div class="col-md-12">
  <h2>
<span class="fa" style="width:50px;"><span class="orangetxt fa-arrow-circle-right rightarticles " id="articles"> </span>
<span class="orangetxt fa-arrow-circle-left hideme leftarticles" id="articles"> </span></span>

  Articles</h2> 
  	<div class="contentbox hideme" id="showarticles">	
					<?php foreach($articles as $article){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
        <div class="row <?php echo $class; ?>">
            <div class="col-sm-3">
              <strong><?php echo $article->name; ?></strong><BR>
              <?=$article->source?><BR>
              <?php if(!empty($article->created)) { echo  $article->created; } ?>     
            </div>
            <div class="col-sm-9">
              <?php echo $article->short; ?>
            </div>
        </div>	
					<?php  } ?>
    </div>				
</div>
</div>
<?php } ?>



</div>

<script type="text/javascript">

$(document).ready(function() {

    $("span.orangetxt.fa-arrow-circle-right").click(function() {
        var id = $(this).attr("id"); 
        $(".hideme").hide(); // hide all other sections                       
        $("#show" + id).fadeIn("slow");
        $(".fa-arrow-circle-right").fadeIn("slow");
        $(".right" + id).fadeOut("slow");
        $(".left" + id).fadeIn("slow"); 

    });
    
    $("span.orangetxt.fa-arrow-circle-left").click(function() {
        var id = $(this).attr("id"); 
        $(".hideme").hide(); // hide all other sections
        $(".left").fadeOut("slow");
        $(".fa-arrow-circle-right").fadeIn("slow");                       

    });

});
</script>