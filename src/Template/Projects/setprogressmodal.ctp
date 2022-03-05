<H1>Set the progress on Stage <?php echo $complete; ?></H1>
<h4>Please set the progress completed so far for this stage</h4>

<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'projects','action' => 'setprogressaction']]); ?>
<?= $this->Form->hidden('slug', ['value'=>$project->slug]); ?>
<?= $this->Form->hidden('stage', ['value'=>$complete]); ?>
<?php 
$progress = array(
    '10' => '10%',
    '20' => '20%',
    '30' => '30%',
    '40' => '40%',
    '50' => '50%',
    '60' => '60%',
    '70' => '70%',
    '80' => '80%',
    '90' => '90%',
    '100' => '100%'
);

echo $this->Form->input('progress', ['options' => $progress, 'class'=>'form-control', 'label' => false, 'default' => $percentage, 'empty'=>'Set the progress >>']);  ?>
<?= $this->Form->button(__('Set Progress'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']) ?>
<?php  echo $this->Form->end(); ?>
<BR><BR>