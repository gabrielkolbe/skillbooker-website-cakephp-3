<style>
.topside {
background-color: #000;
min-height: 25px;
line-height: 25px;
color:#fff;
}
.topside a {
color:#fff;
}
</style>
<div class="row topside">
        <div class="col-xs-12 col-md-6"> 
          	<?php	
            if (!empty($this->request->session()->read('Auth.User.id'))) { ?>
          							<span class="dropdown float-left">
                         <?php  echo $this->Html->link('Welcome '.$this->request->session()->read('Auth.User.firstname').' '.$this->request->session()->read('Auth.User.lastname').' <span class="caret"></span>','javascript:void(0);',array('escape'=>false, 'class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'role'=>"button", 'aria-expanded'=>"false")); ?>
          								<ul role="menu" class="dropdown-menu pull-right">

          									<li><?php echo $this->Html->link('My Projects',['plugin'=>null, 'controller'=>'projects', 'action'=>'lists']); ?></li>									
          									<li><?php echo $this->Html->link('My Bids',['plugin'=>null, 'controller'=>'bids', 'action'=>'index']); ?></li>
          									<li><?php echo $this->Html->link('Portfolio',['plugin'=>null,'controller'=>'portfolio', 'action'=>'index']); ?></li>
          									<li><?php echo $this->Html->link('Software',['plugin'=>null,'controller'=>'softwares', 'action'=>'index']); ?></li>
                            <li><?php echo $this->Html->link('Questions',['plugin'=>null, 'controller'=>'questions', 'action'=>'index']); ?></li>
                            <li><?php echo $this->Html->link('Job Applications',['plugin'=>null, 'controller'=>'applications', 'action'=>'lists']); ?></li>
                            <li><?php echo $this->Html->link('Resumes/CV\'s',['plugin'=>null,'controller'=>'resumes', 'action'=>'index']); ?></li>
          									<li><?php echo $this->Html->link('Online CV/Resume',['plugin'=>null, 'controller'=>'online', 'action'=>'cv', $this->request->session()->read('Auth.User.slug')]); ?></li>
          									<li><?php echo $this->Html->link('My Jobs',['plugin'=>'jobboard', 'controller'=>'jobs', 'action'=>'jobs']); ?></li>
          									<li><?php echo $this->Html->link('Messenger',['plugin'=>null, 'controller'=>'messenger', 'action'=>'index']); ?></li>
                            <li><?php echo $this->Html->link('My Payments',['plugin'=>null, 'controller'=>'payments', 'action'=>'index']); ?></li>
                            <li><?php echo $this->Html->link('Logout',['plugin'=>null, 'controller'=>'users', 'action'=>'logout']); ?></li>
          								</ul>
          							</span>
               <?php } ?>
        </div>                 
        <div class="col-xs-12 col-md-6 bigger480">
        <span class="float-right">
              <?php if (is_null($this->request->session()->read('Auth.User.id'))) { echo $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']); } else {
                $userid = $this->request->session()->read('Auth.User.id');
                $subscription = $this->request->session()->read('Auth.User.subscription');
                $subscriptiondate = $this->request->session()->read('Auth.User.subscriptiondate');
                $softwarecredit = $this->request->session()->read('Auth.User.softwarecredit');
                $jobcredit = $this->request->session()->read('Auth.User.jobcredit');
                if($userid == 1) { echo $this->Html->link('CMS',['plugin'=>'manager', 'controller'=>'Sitesettings', 'action'=>'index']); echo '&nbsp;|&nbsp;'; }
                
if($subscription == 'Premium') {
  if(strtotime($subscriptiondate) > strtotime('-1 year')) {
   echo 'Subscription: '.$subscription; echo '&nbsp;|&nbsp;';
  } else {
    echo $this->Html->link('Subscription Expired: '.$subscription,['plugin'=>null, 'controller'=>'salesoptions', 'action'=>'freelancers']); echo '&nbsp;|&nbsp;';
  }
} else {
    echo $this->Html->link('Subscription: '.$subscription,['plugin'=>null, 'controller'=>'salesoptions', 'action'=>'freelancers']); echo '&nbsp;|&nbsp;';
    echo $this->Html->link('Software Credit: '.$softwarecredit,['plugin'=>null, 'controller'=>'salesoptions', 'action'=>'software']); echo '&nbsp;|&nbsp;';
    echo $this->Html->link('Job Credit: '.$jobcredit,['plugin'=>null, 'controller'=>'salesoptions', 'action'=>'jobs']); echo '&nbsp;|&nbsp;';
}
echo $this->Html->link('Logout',['plugin'=>null, 'controller'=>'users', 'action'=>'logout']); } ?>
        </span>
        </div>
</div>