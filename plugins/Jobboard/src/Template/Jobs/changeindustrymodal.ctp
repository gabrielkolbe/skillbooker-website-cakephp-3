<H1>Change Career Category</H1>
<p>Change your default search category</p>

<?php echo $this->Form->create(null,  ['url' => ['plugin' => 'jobboard','controller' => 'jobs','action' => 'changeindustrymodalaction']]); ?>
<?= $this->Form->button(__('Apply'), ['class'=>'btn btn-primary float-right']) ?> 
<?php 
foreach($industries as $industry){  ?>
          
						<?php
							echo ' <input type="radio" name="industries" value="'.$industry->id.'"><label>'.$industry->name.'</label><br>';
						?>
          
<?php } ?>
<?php  echo $this->Form->end(); ?>