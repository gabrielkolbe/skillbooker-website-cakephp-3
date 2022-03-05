<!-- header -->

	<div class="top_bar">
		<div class="container">  
      <div class="row">
        
        <div class="col-xs-6 col-md-6 align-left">
<?php 
if (!empty($this->request->session()->read('Auth.User.id'))) {
?>
<span class="bigger480"> 
          <span class="caret"></span> &nbsp;<?php echo $this->Html->link('My Manager',['plugin'=>null,'controller'=>'portfolio', 'action'=>'index']); ?> 
          &nbsp;|&nbsp; 
<?php          
          $subscription = $this->request->session()->read('Auth.User.subscription');
          echo $this->Html->link('Subscription: '.$subscription,['plugin'=>null, 'controller'=>'salesoptions', 'action'=>'freelancers']); echo '&nbsp;|&nbsp;';
?>
</span>
<?php } else { ?>

          							<span class="dropdown smaller1024">
                         <?php  echo $this->Html->link('Browse <span class="caret"></span>','javascript:void(0);',array('escape'=>false, 'class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'role'=>"button", 'aria-expanded'=>"false")); ?>
          								<ul role="menu" class="dropdown-menu pull-right">
          									<li><?= $this->Html->link('FreeLance Projects', 'freelance_projects'); ?></li>									
          									<li><?= $this->Html->link('Software Market', 'software_market'); ?></li>
                            <li><?= $this->Html->link('Jobs Market', 'job_market') ?></li>
                            <li><?= $this->Html->link('Tutorials', ['plugin' => null, 'controller' => 'Tutorials', 'action' => 'index']) ?></li>
          									<li><?= $this->Html->link('Portfolio', ['plugin' => null, 'controller' => 'Portfolio', 'action' => 'index']) ?></li>          								
                          </ul>
          							</span>
<?php } ?>  

        </div>                 
        <div class="col-xs-6 col-md-6 align-right">
            
          	<?php	
            if (!empty($this->request->session()->read('Auth.User.id'))) { ?>
          							<span class="dropdown">
                         <?php  echo $this->Html->link('Welcome '.$this->request->session()->read('Auth.User.firstname').' '.$this->request->session()->read('Auth.User.lastname').' <span class="caret"></span>','javascript:void(0);',array('escape'=>false, 'class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'role'=>"button", 'aria-expanded'=>"false")); ?>
          								<ul role="menu" class="dropdown-menu pull-right farright">
          									<li><?php echo $this->Html->link('My Manager',['plugin'=>null,'controller'=>'portfolio', 'action'=>'index']); ?></li>
                            <li><?php echo $this->Html->link('Logout',['plugin'=>null, 'controller'=>'users', 'action'=>'logout']); ?></li>          								
                          </ul>
          							</span>
             <?php  
           if (!empty($this->request->session()->read('Auth.User.avatar'))) { ?>
                      <span class="bigger480 aui-avatar aui-avatar-small">
                          <span class="aui-avatar-inner">
                            <?php
                            $picture = $this->request->session()->read('Auth.User.avatar'); 
                              echo $this->Html->image('/img/uploads/avatars/'.$picture); 
                            ?>
                          </span>
                        </span
            <?php } ?>
          	<?php } else { ?>
          					<span class="dropdown">
                    <span onClick="sendajax('/users/loginmodal/')">Login</span>&nbsp;&nbsp;|&nbsp; 
                    <span onClick="sendajax('/users/registermodal/')">Register</span>
          					</span>
          				
          				<?php } ?> 
            
            
        </div><!-- close col4 -->
      </div><!-- close row -->
        
		</div> <!-- close container -->
	</div> </div><!-- close topbar -->