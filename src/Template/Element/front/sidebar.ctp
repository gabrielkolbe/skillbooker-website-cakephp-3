<style>
.menu_hide {
display:none;
}
</style>

<?php
$active_jobs = '';
$active_projects = '';
$active_activity = '';
$active_links = '';
$active_portfolio = '';
$active_software = '';
$active_questions = '';
$active_tools = '';
   

$menu_jobs = 'menu_hide';
$menu_projects = 'menu_hide';
$menu_activity = 'menu_hide';
$menu_links = 'menu_hide';
$menu_portfolio = 'menu_hide';
$menu_software = 'menu_hide';
$menu_questions = 'menu_hide';
$menu_tools = 'menu_hide';
 
switch ($setstate) {

  case 'jobs':
        $active_jobs = 'active';
        $menu_jobs = 'active';
        break;
  case 'projects':
        $active_projects = 'active';
        $menu_projects = 'active';
        break;
  case 'activity':
        $active_activity = 'active';
        $menu_activity = 'active';
        break;
  case 'links':
        $active_links = 'active';
        $menu_links = 'active';
        break;
  case 'portfolio':
        $active_portfolio = 'active';
        $menu_portfolio = 'active';
        break;
  case 'software':
        $active_software = 'active';
        $menu_software = 'active';
        break;
  case 'questions':
        $active_questions = 'active';
        $menu_questions = 'active';
        break;
  case 'tools':
        $active_tools = 'active';
        $menu_tools = 'active';
        break;
}

?>
      
 <nav class="sidebar-nav">
          <div class="sidebar-header">
       <BR>
       <span class="topname">
            <?php  echo '<span class="arrow right"></span> &nbsp;'; echo $this->Html->link('Skillbooker','/');  ?>      
        </span> 
          </div>

          <div class="collapse nav-toggleable-sm" id="nav-toggleable-sm">

            <ul id="nav_sidebar" class="sidenav">
            
                <li  class="<?= $active_projects ?>"><a href="#" class="subtitle">Projects</a>
                  <ul class="nav_sidebar <?= $menu_projects?>">
                    <li><?= $this->Html->link('Search',['plugin' => null, 'controller' => 'projects', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('My Projects',['plugin' => null, 'controller' => 'projects', 'action' => 'lists']) ?></li>
                    <li><?= $this->Html->link('My Bids',['plugin' => null, 'controller' => 'bids', 'action' => 'index']) ?></li>
                  </ul>
                </li>
                
               <li  class="<?= $active_questions ?>"><a href="#" class="subtitle">Questions</a>
                  <ul class="nav_sidebar <?= $menu_questions?>">
                    <li><?= $this->Html->link('My Questions',['plugin' => null, 'controller' => 'Questions', 'action' => 'lists']) ?></li>                    
                  </ul>
                </li>   
                
                <li  class="<?= $active_software ?>"><a href="#" class="subtitle">Software</a>
                  <ul class="nav_sidebar <?= $menu_software?>">
                    <li><?= $this->Html->link('Search',['plugin' => null, 'controller' => 'softwares', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('My Software',['plugin' => null, 'controller' => 'softwares', 'action' => 'lists']) ?></li>
                  </ul>
                </li>             

                  <li  class="<?= $active_jobs ?>"><a href="#" class="subtitle">Jobs</a>
                  <ul class="nav_sidebar <?= $menu_jobs?>">
                    <li><?= $this->Html->link('Search',['plugin' => 'jobboard', 'controller' => 'Jobs', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('My Jobs',['plugin' => 'jobboard', 'controller' => 'Jobs', 'action' => 'jobs']) ?></li>                    
                    <li><?= $this->Html->link('Candidate Applications',['plugin' => null, 'controller' => 'applications', 'action' => 'lists']) ?></li>
                    <li><?= $this->Html->link('My Applications',['plugin' => null, 'controller' => 'applications', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Add Credits',['plugin' => null, 'controller' => 'salesoptions', 'action' => 'jobs']) ?></li>
                  </ul>
                </li>
              
                
                <li class="<?= $active_portfolio ?>"><a href="#" class="subtitle">Portfolio</a>
                  <ul class="nav_sidebar <?= $menu_portfolio?>">
                    <li><?= $this->Html->link('Edit Portfolio',['plugin'=>null,'controller'=>'portfolio', 'action'=>'index']) ?></li>
                    <li><?= $this->Html->link('Online CV/Resume',['plugin'=>null, 'controller'=>'online', 'action'=>'cv', $this->request->session()->read('Auth.User.slug')]); ?></li>                    
                    <li><?= $this->Html->link('Uploaded Resume/CV',['plugin'=>null,'controller'=>'resumes', 'action'=>'index']) ?></li>
                    <li><?= $this->Html->link('Employment',['plugin' => null, 'controller' => 'employment', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Qualifications',['plugin' => null, 'controller' => 'qualification', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Publications',['plugin' => null, 'controller' => 'publication', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Articles',['plugin' => null, 'controller' => 'article', 'action' => 'index']) ?></li>
                  </ul>
                </li>
                
                
                <li class="<?= $active_tools ?>"><a href="#" class="subtitle">Tools</a>
                  <ul class="nav_sidebar <?= $menu_tools?>">
                    <li><?= $this->Html->link('Timesheets',['plugin'=>null,'controller'=>'timesheets', 'action'=>'index']) ?></li>
                  </ul>
                </li>
                
                <li  class="<?= $active_activity ?>"><a href="#" class="subtitle">Activity</a>
                  <ul class="nav_sidebar <?= $menu_activity ?>">                  
                    <li><?= $this->Html->link('Messenger',['plugin'=>null, 'controller'=>'messenger', 'action'=>'index']) ?></li>
                    <li><?= $this->Html->link('Payments',['plugin'=>null, 'controller'=>'payments', 'action'=>'index']) ?></li>
                  </ul>
                </li>
               
                <li  class="<?= $active_links?>"><a href="#" class="subtitle">Links</a>
                  <ul class="nav_sidebar <?= $menu_links ?>">
                    <li><?php echo $this->Html->link('Contact','contact'); ?></li>
                    <li><?= $this->Html->link('Tutorials',['plugin'=>null,'controller'=>'tutorials','action'=>'index']) ?></li>
                    <li><?php echo $this->Html->link('Freelancers Costs','/salesoptions/freelancers'); ?></li>
                    <li><?php echo $this->Html->link('Job Listing Costs','/salesoptions/jobs'); ?></li> 
                    <li><?php echo $this->Html->link('Software Listing Costs','/salesoptions/software'); ?></li>
                    <li><?php echo $this->Html->link('Terms and Conditions','terms-and-conditions'); ?></li>       
                    <li><?php echo $this->Html->link('Privacy Policy','privacy-policy'); ?></li>
                  </ul>
                </li>


            </ul>
            <hr class="visible-xs m-t">
          </div>
        </nav>