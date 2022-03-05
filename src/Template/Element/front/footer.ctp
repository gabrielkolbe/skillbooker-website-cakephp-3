<div class="main_footer">
	<div class="container">
		<div class="row">
      <div class="col-xs-3 col-md-3">
				<h3 class="footer_title">Costs</h3>
        <ul>
          <li><?php echo $this->Html->link('Software Listing Costs',['plugin'=>null,'controller'=>'salesoptions','action'=>'software']); ?></li>          
          <li><?php echo $this->Html->link('Job listing Costs',['plugin'=>null,'controller'=>'salesoptions','action'=>'jobs']); ?></li>
          <li><?php echo $this->Html->link('Freelancer Costs',['plugin'=>null,'controller'=>'salesoptions','action'=>'freelancers']); ?></li>       
        </ul>
      </div>
			<div class="col-xs-3 col-md-3">
        <h3 class="footer_title">Links</h3>	
				<ul>
          <li><?php echo $this->Html->link('Tutorials',['plugin'=>null,'controller'=>'tutorials','action'=>'index']); ?></li>
          <li><?php echo $this->Html->link('Expired Jobs',['plugin'=>'jobboard','controller'=>'jobs','action'=>'expired']); ?></li> 
          <li><?php echo $this->Html->link('Software Categories','software_market'); ?></li>          
				</ul>
			</div>
      
      <div class="col-xs-3 col-md-3">
        <h3 class="footer_title">Communications</h3>	
				<ul> 
          <li><?php echo $this->Html->link('Contact','contact'); ?></li>        
          <li><?php echo $this->Html->link('About Us','about'); ?></li>
          <li><?php echo $this->Html->link('Questions',['plugin'=>null,'controller'=>'Questions','action'=>'index']); ?></li>
				</ul>
			</div>
      
      <div class="col-xs-3 col-md-3">
        <h3 class="footer_title">Terms</h3>	
				<ul>
          <li><?php echo $this->Html->link('Terms and Conditions','terms-and-conditions'); ?></li>
          <li><?php echo $this->Html->link('Privacy Policy','privacy-policy'); ?></li> 
				</ul>
			</div>
                                    
		</div>
	</div>
</div>
<div class="footer_btm">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8">
         <p>Copyright &copy; <?= date('Y') ?> - <?= SITE ?>. All rights reserved. </p>
			</div>
            <div class="col-md-4 text-right bigger480">
             <ul class="list-inline social-buttons">
                    <li><a href="http://<?= GOOGLEICONLINK ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="http://<?= FACEICONLINK ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="http://<?= LINKEDINICONLINK ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="http://<?= TWITTERICONLINK ?>" target="_blank"><i class="fa fa-google"></i></a></li>

              </ul>
		</div>
	</div>
</div>
