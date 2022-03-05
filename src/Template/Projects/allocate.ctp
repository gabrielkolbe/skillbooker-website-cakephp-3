<H1>Allocate '<?php echo $project->name; ?>' 
to  <?php echo $user->name; ?></H1>
<BR>
<p>By allocating this project to <?php echo $user->name; ?>, you undertake to:<BR>
<ol class='thelist'>
<li>Provide  <?php echo $user->name; ?> all he/she needs to do the work </li>
<li>Communicate effectively via Skillbooker Ltd messenger 
(incase disagreements arise we will only use our own messenger system to arbitrate between parties).  </li>
<li>Release payment via Skillbooker Ltd to <?php echo $user->name; ?> when agreed work is fullfilled.</li>
<li>All other bids will be made void.</li>

</ol>

<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'projects','action' => 'allocateaction']]); ?>
<?php  echo $this->Form->hidden('id', ['value'=>$bids->id]); ?>
<?php  echo $this->Form->hidden('slug', ['value'=>$project->slug]); ?>


<?= $this->Form->button(__('Allocate Project'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']) ?>
<?php  echo $this->Form->end(); ?>
<BR><BR>