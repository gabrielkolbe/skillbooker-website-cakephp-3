<?php echo $this->Form->create(null,  ['url' => ['plugin' => null, 'controller' => 'projects', 'action' => 'rateaction']]); ?>
<?= $this->Form->hidden('id', ['value'=>$bids->id]); ?>
  <h1>Rate this Bid</h1>
  <BR>

    <span class="rating">
    <input type="radio" class="rating-input" id="rating-input-5" name="rating" value="5" <?php if($bids->rating == 5) { echo 'checked'; } ?> >
    <label for="rating-input-5" class="rating-star"></label>
    <input type="radio" class="rating-input" id="rating-input-4" name="rating"  value="4" <?php if($bids->rating == 4) { echo 'checked'; } ?> >
    <label for="rating-input-4" class="rating-star"></label>
    <input type="radio" class="rating-input" id="rating-input-3" name="rating" value="3" <?php if($bids->rating == 3) { echo 'checked'; } ?> >
    <label for="rating-input-3" class="rating-star"></label>
    <input type="radio" class="rating-input" id="rating-input-2" name="rating"  value="2" <?php if($bids->rating == 2) { echo 'checked'; } ?> >
    <label for="rating-input-2" class="rating-star"></label>
    <input type="radio" class="rating-input" id="rating-input-1" name="rating"  value="1" <?php if($bids->rating == 1) { echo 'checked'; } ?> >
    <label for="rating-input-1" class="rating-star"></label>
    </span>
    
<BR>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
<BR><BR>
<?php echo $this->Form->end();?>
