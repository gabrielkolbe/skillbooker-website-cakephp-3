<div class="row">
  <div class="col-md-12">
  <span onClick="sendajax('/resumes/addresume/')" class="btn btn-primary btn-xs float-right">Add A Resume</span>
  <span onClick="sendajax('/resumes/setdefault/')" class="btn btn-primary btn-xs float-right">Set Default</span>
<legend>Uploaded Resumes / CV's</legend>
<?php 
$class="one";
$color1="one"; 
$color2="two";
?>

<?php if(!empty($resumes)){ ?>
<div class="row"> 
	<div class="col-md-12">
  	<div class="contentbox">	
					<?php foreach($resumes as $resume){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
        <div class="row <?php echo $class; ?>">
            <div class="col-sm-12">
                  <?= $this->Form->postLink(__('Delete Resume'), ['controller'=>'resumes', 'action' => 'deleteresume', $resume->id], ['confirm' => __('Are you sure you want to delete this resume:   {0}?', $resume->name), 'class' => 'btn btn-danger btn-xs float-right']) ?>
              <?php if($resume->is_default == 1) { ?> <span class="orange">Default</span><?php } ?>
              <strong><span class="fa fa-chevron-circle-down">&nbsp;</span><?= $this->Html->link($resume->name, ['action' => 'download', $resume->id ]) ?></strong>
              <BR>
              <?php echo $resume->created; ?>     
            </div>
        </div>	
					<?php } ?>
    </div>				
</div>
</div>
<?php } ?>
</div>
</div>