<?php echo $this->Form->create($candidate,  ['url' => ['plugin' => null, 'controller' => 'portfolio', 'action' => 'editsummaryaction']]); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>   
<h1>Edit Summary</h1> 	
   <p><small><i>This <strong>summary will appear on your online CV/Resume</strong> please write a personalised message about your character, personality, working enviroment preferences, skills and experience</i></small></p>
<?php echo $this->Form->textarea("summary",['class'=>'form-control ckeditor', 'id'=>'summary', "placeholder"=>"Summary of who you are and what you do", 'required' => true]);  ?>

<?= $this->Form->end() ?>
