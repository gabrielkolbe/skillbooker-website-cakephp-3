<?php echo $this->Form->create(null,  ['url' => ['plugin' => null, 'controller' => 'skills', 'action' => 'addaction']]); ?>
<div class="row">
	<div class="col-md-11">
  <?php if(!empty($skills)){  ?>
  <h1>Add A Skill for Industry:<?php echo $display_industry; ?></h1>
  <?php } else { ?>
  <h1>There is no pre-selected skills for Industry: <?php echo $display_industry; ?></h1>
  <?php } ?>
  (change industry under 'User Details')
  </div>
  	<div class="col-md-1">
  <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  </div>
 </div> 
 
 <HR>
<h2>Add skills if not in list</h2>

      <div class="row">
				<div class="col-sm-12">
					<?php echo $this->Form->text("skill_name",['class'=>'form-control', 'placeholder'=>'Comma separated list']);  ?>
				</div>
			</div>
<HR> 

   <div class="row list"> 
    <div class="col-md-4">
 
   	 <?php
        $i = 1; 
				if(!empty($skills)){
        
				$count = count($skills);
        $colum = round($count/3);
        	
					foreach($skills as $key => $jtype){
          if ($i % $colum === 0) { ?>
             </div>
             <div class="col-md-4">        
              <?php  }
                $i++;
      				?>	
      					<label>
      						<?php
                  if (in_array($jtype, $userskills)) { 
                  echo $this->Form->checkbox('skill_id[]', ['checked'=>true, 'hiddenField' => false, 'value' => $key]).'&nbsp;';
                   } else {
                  echo $this->Form->checkbox('skill_id[]', ['hiddenField' => false, 'value' => $key]).'&nbsp;';
                   } 
      							
      							echo $jtype;
      						?>
      					</label><BR>
				<?php
					}
				}
			?>
        </div><!-- close loop -->
    </div>
   

<?php echo $this->Form->end();?>

	</div>
</div>