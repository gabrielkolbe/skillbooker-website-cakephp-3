<?php $this->Html->script('jquery-ui', ['block'=>true]); ?>
<?php 
$class="one";
$color1="one"; 
$color2="two";
?>
<div class="row"> 
	<div class="col-md-12">
  <BR>
    <legend>Employment</legend> 

<span onClick="sendajax('/employment/add')" class="btn btn-primary btn-xs float-right">Add Employment</span>
<span onClick="sendajax('/employment/sort/')" class="btn btn-primary btn-xs float-right">Sort Employment Order</span>

 <div><BR>&nbsp;</div>  
  	<div class="contentbox">
    				<?php if(!empty($employments)){ ?>
					<?php foreach($employments as $employment){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
            <div class="row <?php echo $class; ?>">
                  <div class="col-sm-3">
                  <?php if($employment->displayme == 1){ ?>
                 <img src='../img/tick20.png'> Display on Online CV/Resume
                <?php } else { ?>
                 <img src='../img/wrong20.png'> Not displaying on Online CV/Resume
                 <?php } ?><BR>                    
              <strong><?php echo $employment->company; ?></strong><BR>
                    <?=$employment->position?><BR>
                    <?php if(!empty($employment->from_date)) { echo  $employment->from_date; ?>  - <?php echo $employment->to_date.'<BR>'; } ?>
                    <?php echo  $employment->job_location; ?>            
                  </div>
                  <div class="col-sm-9">
                  <?= $this->Form->postLink(__('Delete'), ['plugin'=>null, 'controller'=>'employment', 'action' => 'deleteemployment', $employment->id], ['confirm' => __('Are you sure you want to delete this employment:   {0}?', $employment->position), 'class' => 'btn btn-danger btn-xs float-right']) ?>
                  <span onClick="sendajax('/employment/edit/<?php echo $employment->id; ?>')" class="btn btn-primary btn-xs float-right">Edit</span>
                    <h3><?php echo  $employment->position; ?></h3>
                    <?php echo $employment->description; ?>
                  </div>
              </div>	
					<?php } } ?>
    </div>				
</div>
</div>