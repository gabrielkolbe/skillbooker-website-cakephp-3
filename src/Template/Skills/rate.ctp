<?php echo $this->Form->create(null,  ['url' => ['plugin' => null, 'controller' => 'skills', 'action' => 'rateaction']]); ?>
<div class="row">
	<div class="col-md-6">
  <h1>Rate Your Skills</h1>
  </div>
  	<div class="col-md-6">
  <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
  </div>
 </div> 
    
<?php  if (!empty($skills)) { ?>
    
<table class="table table-bordered table-striped" align="center" border="0">
  <thead>
    <tr>
    <td style="width:25%"></td>
    <td style="width:75%"></td>
    </tr>
  </thead>
  <tbody >
      <?php foreach ($skills as $skill) { ?>
        <tr>
          <td>
          
          <span class="rating">
            <input type="radio" class="rating-input" id="rating-input-<?php echo $skill->id; ?>-5" name="rating[<?php echo $skill->id; ?>]" value="5" <?php if( $skill->level == 5) { echo 'checked="checked"'; } ?>>
            <label for="rating-input-<?php echo $skill->id; ?>-5" class="rating-star"></label>
            <input type="radio" class="rating-input" id="rating-input-<?php echo $skill->id; ?>-4" name="rating[<?php echo $skill->id; ?>]"  value="4" <?php if( $skill->level == 4) { echo 'checked="checked"'; } ?>>
            <label for="rating-input-<?php echo $skill->id; ?>-4" class="rating-star"></label>
            <input type="radio" class="rating-input" id="rating-input-<?php echo $skill->id; ?>-3" name="rating[<?php echo $skill->id; ?>]" value="3" <?php if( $skill->level == 3) { echo 'checked="checked"'; } ?>>
            <label for="rating-input-<?php echo $skill->id; ?>-3" class="rating-star"></label>
            <input type="radio" class="rating-input" id="rating-input-<?php echo $skill->id; ?>-2" name="rating[<?php echo $skill->id; ?>]"  value="2" <?php if( $skill->level == 2) { echo 'checked="checked"'; } ?>>
            <label for="rating-input-<?php echo $skill->id; ?>-2" class="rating-star"></label>
            <input type="radio" class="rating-input" id="rating-input-<?php echo $skill->id; ?>-1" name="rating[<?php echo $skill->id; ?>]"  value="1" <?php if( $skill->level == 1) { echo 'checked="checked"'; } ?>>
            <label for="rating-input-<?php echo $skill->id; ?>-1" class="rating-star"></label>
          </span>
          
          </td>
          <td><?php echo $skill->skill_name; ?></td>    
        </tr>
        <tr>
          <td>&nbsp;<td></td>&nbsp;</td>
        </tr>
      <?php } ?>
  </tbody>
</table>
<?php } ?>
<?php echo $this->Form->end();?>
	</div>
</div>