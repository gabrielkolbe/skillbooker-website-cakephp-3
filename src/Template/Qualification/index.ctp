<?php $this->Html->script('jquery-ui', ['block'=>true]); ?>
<?php 
$class="one";
$color1="one"; 
$color2="two";
?>
<div class="row"> 
	<div class="col-md-12">
  <BR>
  <legend>Qualifications</legend>
  <span onClick="sendajax('/qualification/add')" class="btn btn-primary btn-xs float-right">Add Qualification</span>
  <span onClick="sendajax('/qualification/sort/')" class="btn btn-primary btn-xs float-right">Sort Qualification Order</span>
    <div><BR>&nbsp;</div>  
  	<div class="contentbox">
    				<?php if(!empty($qualifications)){ ?>
					<?php foreach($qualifications as $qualification){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
            <div class="row <?php echo $class; ?>">
                  <div class="col-sm-3">
                  <?php if($qualification->displayme == 1){ ?>
                 <img src='../img/tick20.png'> Display on Online CV/Resume
                <?php } else { ?>
                 <img src='../img/wrong20.png'> Not displaying on Online CV/Resume
                 <?php } ?><BR>                    
              <strong><?php echo $qualification->name; ?></strong><BR>
                    <?php if(!empty($qualification->from_date)) { echo  $qualification->from_date; ?>  - <?php echo $qualification->to_date.'<BR>'; } ?>
                    <?php echo  $qualification->institution; ?>            
                  </div>
                  <div class="col-sm-9">
                  <?= $this->Form->postLink(__('Delete'), ['plugin'=>null, 'controller'=>'qualification', 'action' => 'deletequalification', $qualification->id], ['confirm' => __('Are you sure you want to delete this qualification:   {0}?', $qualification->name), 'class' => 'btn btn-danger btn-xs float-right']) ?>
                  <span onClick="sendajax('/qualification/edit/<?php echo $qualification->id; ?>')" class="btn btn-primary float-right btn-xs">Edit</span>
                    <h3><?=$qualification->name?></H3>
                    <?php echo $qualification->description; ?>
                  </div>
              </div>	
					<?php } } ?>
    </div>				
</div>
</div>