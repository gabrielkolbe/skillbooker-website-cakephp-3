<div class="row">
	<div class="col-md-12">
  <h1>Rate Skill: <?php echo $skill['skill_name']; ?></h1>
  <BR>
 <?= $this->Form->postLink(__('Delete'), ['plugin'=>null, 'controller'=>'skills', 'action' => 'deleteskill', $skill['id']], ['confirm' => __('Are you sure you want to delete this skill:   {0}?', $skill['skill_name']), 'class' => 'btn btn-danger float-right']) ?>		
<?php echo $this->Form->create(null,  ['url' => ['plugin' => null, 'controller' => 'skills', 'action' => 'editaction']]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
<?php echo $this->Form->hidden("id",['value'=>$skill['id']]); ?>

<span class="rating">
    <input type="radio" class="rating-input" id="rating-input-<?php echo $skill['id']; ?>-5" name="level" value="5" <?php if( $skill['level'] == 5) { echo 'checked="checked"'; } ?>>
    <label for="rating-input-<?php echo $skill['id']; ?>-5" class="rating-star"></label>
    <input type="radio" class="rating-input" id="rating-input-<?php echo $skill['id']; ?>-4" name="level"  value="4" <?php if( $skill['level'] == 4) { echo 'checked="checked"'; } ?>>
    <label for="rating-input-<?php echo $skill['id']; ?>-4" class="rating-star"></label>
    <input type="radio" class="rating-input" id="rating-input-<?php echo $skill['id']; ?>-3" name="level" value="3" <?php if( $skill['level'] == 3) { echo 'checked="checked"'; } ?>>
    <label for="rating-input-<?php echo $skill['id']; ?>-3" class="rating-star"></label>
    <input type="radio" class="rating-input" id="rating-input-<?php echo $skill['id']; ?>-2" name="level"  value="2" <?php if( $skill['level'] == 2) { echo 'checked="checked"'; } ?>>
    <label for="rating-input-<?php echo $skill['id']; ?>-2" class="rating-star"></label>
    <input type="radio" class="rating-input" id="rating-input-<?php echo $skill['id']; ?>-1" name="level"  value="1" <?php if( $skill['level'] == 1) { echo 'checked="checked"'; } ?>>
    <label for="rating-input-<?php echo $skill['id']; ?>-1" class="rating-star"></label>
</span>
<?php echo $this->Form->end();?>
<BR><BR>

	</div>
</div>