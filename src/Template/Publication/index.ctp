<?php $this->Html->script('jquery-ui', ['block'=>true]); ?>
<?php 
$class="one";
$color1="one"; 
$color2="two";
?>
<div class="row"> 
	<div class="col-md-12">
  <BR>
   <legend>Publications</legend>
  <span onClick="sendajax('/publication/add')" class="btn btn-primary btn-xs float-right">Add Publication</span>
  <span onClick="sendajax('/publication/sort/')" class="btn btn-primary btn-xs float-right">Sort Publication Order</span>
      <div><BR>&nbsp;</div> 
  	<div class="contentbox">
    				<?php if(!empty($publications)){ ?>
					<?php foreach($publications as $publication){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
            <div class="row <?php echo $class; ?>">
                  <div class="col-sm-3">
                  <?php if($publication->displayme == 1){ ?>
                 <img src='../img/tick20.png'> Display on Online CV/Resume
                <?php } else { ?>
                 <img src='../img/wrong20.png'> Not displaying on Online CV/Resume
                 <?php } ?><BR>                    
              <strong><?php echo $publication->name; ?></strong><BR>
                <?=$publication->publisher?><BR>
                <?=$publication->publishdate?>  
                  </div>
                  <div class="col-sm-9">
                  <?= $this->Form->postLink(__('Delete'), ['plugin'=>null, 'controller'=>'publication', 'action' => 'deletepublication', $publication->id], ['confirm' => __('Are you sure you want to delete this publication:   {0}?', $publication->name), 'class' => 'btn btn-danger btn-xs float-right']) ?>
                  <span onClick="sendajax('/publication/edit/<?php echo $publication->id; ?>')" class="btn btn-primary btn-xs float-right">Edit</span>
                    <h3><?=$publication->name?></H3>
                    <?php echo $publication->description; ?>
                  </div>
              </div>	
					<?php } } ?>
    </div>				
</div>
</div>