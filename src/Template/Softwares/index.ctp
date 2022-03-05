<div class="row">

  <div class="col-xs-12 col-md-10">
    <h1 class="toph1"><?php if(!empty($categoryname)) { echo $categoryname; } else {
    echo 'Software Market'; }   ?></h1>
  </div>
  <div class="col-xs-12 col-md-2">
      <?= $this->Html->link(__('Browse Categories'), ['plugin' => null, 'controller' => 'softwares', 'action' => 'categories'], ['class' => 'hoverme float-right']) ?>
  </div>

  <div class="col-xs-12 col-md-4">
  <div class="contentbox padding15">

  <h2>What would you like to see?</h2>
  
  <BR>
  
  <?php if(!empty($features)) { ?>
    <?php echo $this->Form->create('Softwares',['url'=>['plugin'=>null,'controller'=>'softwares','action'=>'category',$categoryslug]]); ?>
  <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'narrowsearch']); ?>
  <?php echo $this->Form->input('categoryslug', ['type' => 'hidden', 'value' => $categoryslug]); ?>
<?php
 foreach($features as $feature) {
       if(in_array($feature->id, $selectfeatures)) { $checked = 'checked'; } else { $checked = ''; } 
        echo '<input name="feature_ids[]"  value="'.$feature->id.'" type="checkbox" '.$checked.' > '.$feature->name.'<BR>';
       }
 ?>
  <?= $this->Form->submit('Narrow Search', ['class'=>'btn btn-primary btn-xs float-right']); ?>
  <?= $this->Form->end(); ?>
  <?php } else { ?>
  
  <?php echo $this->Form->create('Softwares',['url'=>['plugin'=>null,'controller'=>'softwares','action'=>'index']]); ?>
  <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'softwaresearch']); ?>
  <?php echo $this->Form->input('searchword', ['class'=>'form-control', 'label' => false, 'placeholder'=>'e.g. Recruitment Software', 'value' => $search]);  ?>
  <?= $this->Form->submit('Go Search', ['class'=>'btn btn-primary btn-xs float-right']); ?>
  <?= $this->Form->end(); ?>
  
  <?php } ?>
  	
  <BR><BR>
    <div class="sideimg bigger768">
    <img src="/img/lego_305.jpg">
  </div>
    

  <BR><BR>
  </div>
  
  </div>
	<div class="col-xs-12 col-md-8">
    
<?php if( count($softwares) > 0 ) { ?>

		<?php foreach ($softwares as $software): ?>
    <div class="contentbox" style="vertical-align: text-top;"> 
        <h1 class="bluefont"><?= $this->Html->link($software->name, ['plugin' => null, 'controller' => 'softwares', 'action' => 'view', $software->slug]) ?></h1>

<div class="row">
<div class="col-md-2">

<?php if(empty($software->theimage)) { ?>
<img src="/img/squared_comingsoon.png" alt="comingsoon" style="width:100px;">
<?php } else { ?>
<a href="/softwares/view/<?php echo $software->slug; ?>"><img src="/img/software/squared_<?= $software->theimage ?>" alt="<?= $software->name ?>" class="img-rounded margin5 floatleft" style="width:100px;"></a>
<?php } ?>

</div>
<div class="col-md-10 description">

<?= $software->short_description ?>
</div>
</div>

<?= $this->Html->link(__('See More'), ['plugin' => null, 'controller' => 'softwares', 'action' => 'view', $software->slug], ['class' => 'btn btn-primary btn-xs float-right']) ?>

<div class="one" style="display: inline-block;">
 &nbsp;&nbsp;&nbsp;Free Version <?php if($software->freeversion == 1) { ?> <img src="/img/tick20.png"> <?php } else { ?> <img src="/img/wrong20.png"> <?php } ?>
 &nbsp;&nbsp;&nbsp;Free Trail <?php if($software->freetrail == 1) { ?> <img src="/img/tick20.png"> <?php } else { ?> <img src="/img/wrong20.png"> <?php } ?>
 &nbsp;&nbsp;&nbsp;Available Demo <?php if($software->demoavailable == 1) { ?> <img src="/img/tick20.png"> <?php } else { ?> <img src="/img/wrong20.png"> <?php } ?>
 &nbsp;&nbsp;
 </div>

<BR>
 </div>
		
        
<?php endforeach; ?>


    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
    <?php } else { ?>
    <p>There are currenly no software in this category</p>
    <?php } ?>
</div>
</div>