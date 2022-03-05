<H1>Add Extra Hours</H1>
<h4>Hourly rate for this project is <span class="orangetxt"><?php echo $project->denomination ?><?php echo $project->cost1 ?> per hour </span></h4>

 <BR>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'projects','action' => 'addextrahours_action']]); ?>

<?= $this->Form->input('extrahours', ['class'=>'form-control', 'label' => false, 'placeholder'=>"Add extra hours for this project (numbers only, no commas, dots or spaces)", 'required' => true]) ?> 
<?= $this->Form->hidden('slug', ['value'=>$project->slug]); ?>
<span class="orangetxt">Maximum hours 60</span>
<?php echo $this->Form->textarea("notes",['class'=>'form-control ckeditor', "placeholder"=>"Extra notes for extra hours", 'required' => true]);  ?>
<hr>
<p><i>The following message will be send to the <span class="orangetxt"><?=$freelancer->name?></span></i></p>
<BR><p>Hi, <?=$freelancer->name?><BR>
Extra hours had been added to project: '<strong><?php echo $project->name; ?></strong>', please view the workflow page. Once work has been completed payment of
 <?php echo $project->denomination ?><?php echo $project->cost1 ?> per hour will be paid to you.
 Thank you.
<BR>
<hr>

<?= $this->Form->button(__('Submit Bid'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']) ?>
<?php  echo $this->Form->end(); ?>
<BR><BR>
