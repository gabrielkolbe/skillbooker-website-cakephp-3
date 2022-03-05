<?php if(empty($setstate)) { $setstate = 'project'; } ?>
<div class="logo_bar">
		<div class="container">
      <div class="row">
      <div class="col-md-4 align-left">
    <?php

     if(!empty(LOGO)){
              
               echo $this->Html->image(LOGO, [
                'class' => ' logo',
                'alt' => 'logo',
                'url' => '/'
                ]);

        } else { echo $this->Html->link(SITE, HOMEURL); } 
        
      ?>
      </div>


      <div class="col-md-8">
      <?php if($setstate == 'projects') {  echo $this->Html->link(__('Post A Project'), ['plugin' => null, 'controller' => 'projects', 'action' => 'add'], ['class' => 'btn bt-orange float-right bigger480']); } ?>
      <?php if($setstate == 'questions') {  echo $this->Html->link(__('Ask a Question'), ['plugin' => null, 'controller' => 'Questions', 'action' => 'ask'], ['class' => 'btn bt-orange float-right bigger480']); } ?>
      </div>
              
    
      </div><!-- close row -->        
		</div> <!-- close container -->
	</div> <!-- close logobar -->

  
<nav class="middle_nav bigger768">
<div class="container">

      <div class="row middle">

      
        <div class="col-xs-6 col-md-2 <?php if($setstate == 'projects') { echo 'active'; } ?>">
          <?= $this->Html->link('Browse Projects', 'freelance_projects') ?>
        </div>
        
        <div class="col-xs-6 col-md-2 <?php if($setstate == 'questions') { echo 'active'; } ?>">
          <?= $this->Html->link('Software Market', 'software_market') ?>
        </div> 
        
        <div class="col-xs-6 col-md-2 <?php if($setstate == 'jobs') { echo 'active'; } ?>">
          <?= $this->Html->link('Jobs Market', 'job_market') ?>
        </div> 
        
        <div class="col-xs-6 col-md-2 <?php if($setstate == 'tutorials') { echo 'active'; } ?>">
          <?= $this->Html->link('Tutorials', ['plugin' => null, 'controller' => 'Tutorials', 'action' => 'index']) ?>
        </div>
        
        <div class="col-xs-6 col-md-2 <?php if($setstate == 'questions') { echo 'active'; } ?>">
          <?= $this->Html->link('Questions', ['plugin' => null, 'controller' => 'Questions', 'action' => 'index']) ?>
        </div> 
        
        <div class="col-xs-6 col-md-2"></div> 
                                       
      </div>
    </div>
</nav>