<?php $this->Html->css('phpcalendar', ['block'=>true]); ?>
<?php $this->Html->script('jquery-ui', ['block'=>true]); ?>

<div class="row"> 
	<div class="col-md-12">
  <h2>Edit Portfolio</h2>
  
  <span onClick="sendajax('/users/editdetails/')" class="btn btn-primary btn-xs">Edit User Details</span>
  <span onClick="sendajax('/users/changepassword/')" class="btn btn-primary btn-xs">Change Password</span>
    <span onClick="sendajax('/users/changeslugmodal/')" class="btn btn-primary btn-xs">Change Slug</span>
    <?= $this->Html->link(__('View CV/Resume'), ['plugin' => null, 'controller' => 'online', 'action' => 'cv',$user->slug], ['class' => 'btn btn-primary btn-xs']) ?>
  <span onClick="sendajax('/users/deleteconfirm/')" class="btn btn-danger btn-xs">Delete Account</span>
  	
  <div class="contentbox userdetails">   
    <H1><?= $user->firstname ?> <?= $user->lastname ?><?php if(!empty($user->avatar)) { echo $this->Html->image($user->avatar, ['class'=> 'accountimage float-right']); }   ?> </H1>  
    <p><small><i>Content (Jobs, Tutorial ect) will be displayed based on selected Country and Industry</i></small></p>
  <div class="row"> 
	<div class="col-md-6">
  
       <table cellspacing="5" cellpadding="5" class="table table-striped tablefirstbold">
                <tr>
                    <td width="40%">Communication Settings</td>
                    <td><?= $user->display_communicationsetting ?></td>
                </tr>
                <tr>
                    <td width="40%">Country</td>
                    <td><?= $user->display_country ?></td>
                </tr>
                <tr>
                    <td width="40%">Career Category</td>
                    <td><?= $user->display_industry ?></td>
                </tr>                                                               
              </table>
              
    </div>
    
	<div class="col-md-6">
          <table cellspacing="5" cellpadding="5" class="table table-striped tablefirstbold">
                <tr>
                    <td width="20%">Email</td>
                    <td><?= $user->email ?></td>
                </tr>
                <tr>
                    <td width="40%">Telephone</td>
                    <td><?= $user->telephone ?></td>
                </tr>
                <tr>
                    <td width="40%">Mobile</td>
                    <td><?= $user->mobile ?></td>
                </tr>                                                              
              </table>
  </div>
  </div>
  </div>
	
</div>
</div>
<BR>
<div class="row"> 
	<div class="col-md-12">
  <h2>Portfolio Summary</h2>
    <span onClick="sendajax('/portfolio/editsummary/')" class="btn btn-primary btn-xs">Edit User Summary</span>
   <p><small><i>This <strong>summary will appear on your online CV/Resume</strong> please write a personalised message about your character, personality, working enviroment preferences, skills and experience</i></small></p> 	
  <div class="contentbox">     
  <?php echo $candidate->summary; ?>           
  </div>
	
</div>
</div>
<BR>

<div class="row"> 
	<div class="col-md-12">
  <h2>Portfolio Details</h2>
  <p><small><i>The following information is for candidates who are looking for full time / contract positions</i></small></p>  
<span onClick="sendajax('/portfolio/editcandidate/')" class="btn btn-primary btn-xs">Edit Candidate Details</span>
 <?php if($candidate->displayme == 1){ ?>
 <img src='../img/tick20.png'> Display on Online CV/Resume
<?php } else { ?>
 <img src='../img/wrong20.png'> Not displaying on Online CV/Resume
 <?php } ?>
  	
  <div class="contentbox userdetails">   
   <div class="row"> 
  	<div class="col-md-6">
  
       <table cellspacing="5" cellpadding="5" class="table table-striped tablefirstbold">
                <tr>
                    <td width="20%">Ideal Job</td>
                    <td><?= h($candidate->ideal_position) ?></td>
                </tr>
                <tr>
                    <td width="40%">Ideal Locations</td>
                    <td><?= h($candidate->ideal_location) ?></td>
                </tr>
                <tr>
                    <td width="40%">Ideal Salary</td>
                    <td><?= h($candidate->ideal_salary) ?></td>
                </tr>
                    <tr>
                          <td width="40%">Ideal Job Type</td>
                          <td><?= h($candidate->display_jobtype) ?></td>
                      </tr>                    
                    <tr>
                        <td width="40%">Prefered Contact Method</td>
                        <td><?= h($candidate->display_contactmethod) ?></td>
                    </tr>                  
                    <tr>
                          <td width="40%">Available From</td>
                          <td><?= h($candidate->available_from) ?></td>
                      </tr>  
              </table>
              
              
    </div>
    
    	<div class="col-md-6">
              <table cellspacing="5" cellpadding="5" class="table table-striped tablefirstbold">
               <tr>
                    <td width="20%">Link to Google Page</td>
                    <td><?= h($candidate->googleplus) ?></td>
                </tr>
                <tr>
                    <td width="40%">Link to LinkedIn Profile</td>
                    <td><?= h($candidate->linkedin) ?></td>
                </tr>
                <tr>
                    <td width="40%">Link to Twitter</td>
                    <td><?= h($candidate->twitter) ?></td>
                </tr>
                <tr>
                    <td width="40%">Link to Facebook</td>
                    <td><?= h($candidate->facebook) ?></td>
                </tr>
                <tr>
                    <td width="40%">Skype Handle</td>
                    <td><?= h($candidate->skype) ?></td>
                </tr>
                <tr>
                    <td width="40%">Link to own Website/Portfolio</td>
                    <td><?= h($candidate->website) ?></td>
                </tr>
                                               
              </table>
      </div>
    </div>
  </div>
</div>
</div>				
<BR>
  <h2>Availability</h2> 
<div class="row"> 
      <div class="col-md-12">
    <div class="row contentbox"> 
By default you are always available, days you are NOT available will display in <span class='orangetxt'>orange</span><BR>
Click to edit<BR><BR>
  
  <div class="col-md-4">
  <?php echo $calendar1; ?>
  <BR>  
  </div>
  
  <div class="col-md-4">
  <?php echo $calendar2; ?> 
  <BR> 
  </div>
  
  <div class="col-md-4">
  <?php echo $calendar3; ?>  
  </div>     
            </div>  
    </div>			
</div>
<BR>
<div class="row"> 
	<div class="col-md-12">
  <h2>Skills</h2>
   Skills in <strong><?php echo $user->display_industry; ?></strong> industry will be made available ( <span onClick="sendajax('/users/editdetails/')"><u>edit here</u></span> )
  <BR> 
      <span onClick="sendajax('/skills/add/')" class="btn btn-primary btn-xs">Add A Skill</span>
    <span onClick="sendajax('/skills/rate/')" class="btn btn-primary btn-xs">Rate All Skills</span>
  <BR>
    Click on skill to edit
  <div class="contentbox">
  

  <div class="row">	
    <?php if(!empty($skills)){ ?>    
    <div class="col-md-12">
        <h4>Excellent <img src="/img/5littlestar.png" style="width:84px; height:auto;"></h4>      					         
					<?php foreach($skills as $skill){ 
          if($skill->level == 5) { ?>
          <span onClick="sendajax('/skills/edit/<?php echo $skill->id; ?>')" class="btn btn-primary btn-xs"><?php echo $skill->skill_name; ?></span>
					<?php } } ?>
     </div>

     <div class="col-md-12">
      <h4>Good <img src="/img/4littlestar.png" style="width:84px; height:auto;"></h4>     				         
					<?php foreach($skills as $skill){ 
          if($skill->level == 4) { ?>
          <span onClick="sendajax('/skills/edit/<?php echo $skill->id; ?>')" class="btn btn-primary btn-xs"><?php echo $skill->skill_name; ?></span>
					<?php } } ?>
     </div>

     <div class="col-md-12">
     	<h4>Average <img src="/img/3littlestar.png" style="width:84px; height:auto;"></h4>     			         
					<?php foreach($skills as $skill){ 
          if($skill->level == 3) { ?>
          <span onClick="sendajax('/skills/edit/<?php echo $skill->id; ?>')" class="btn btn-primary btn-xs"><?php echo $skill->skill_name; ?></span>
					<?php } } ?>
      </div>  

      <div class="col-md-12">
      	<h4>Basic <img src="/img/2littlestar.png" style="width:84px; height:auto;"></h4>      					         
					<?php foreach($skills as $skill){ 
          if( ($skill->level == 2) || ($skill->level == 1) || ($skill->level == 0) ){ ?>
          <span onClick="sendajax('/skills/edit/<?php echo $skill->id; ?>')" class="btn btn-primary btn-xs"><?php echo $skill->skill_name; ?></span>
					<?php } } ?>

      </div>        

 
    <?php } ?>
    </div>    
</div>			
</div>
</div>