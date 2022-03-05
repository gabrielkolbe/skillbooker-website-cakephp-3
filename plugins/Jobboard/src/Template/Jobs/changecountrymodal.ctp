<H1>Change Country</H1>
<p>Change your default search country</p>

<?php echo $this->Form->create(null,  ['url' => ['plugin' => 'jobboard','controller' => 'jobs','action' => 'changecountrymodalaction']]); ?>
<?= $this->Form->button(__('Apply'), ['class'=>'btn btn-primary float-right']) ?> 
<?php 
foreach($countries as $country){  ?>
          
						<?php
							echo ' <input type="radio" name="country_id" value="'.$country->id.'"><label>'.$country->name.'</label><br>';
						?>
          
<?php } ?>
<?php  echo $this->Form->end(); ?>