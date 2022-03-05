<H1>Set the progress</H1>
<h4>Please set the progress completed so far work</h4>
<BR><BR>

<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'projects','action' => 'extrahourprogress_action']]); ?>
<?= $this->Form->hidden('slug', ['value'=>$values]); ?>
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