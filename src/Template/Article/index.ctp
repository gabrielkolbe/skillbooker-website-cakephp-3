<?php $this->Html->script('jquery-ui', ['block'=>true]); ?>
<?php 
$class="one";
$color1="one"; 
$color2="two";
?>
<div class="row"> 
	<div class="col-md-12">
  <BR>
    <legend>Articles</legend> 
  <span onClick="sendajax('/article/add')" class="btn btn-primary btn-xs float-right">Add Article</span>
  <span onClick="sendajax('/article/sort/')" class="btn btn-primary btn-xs float-right">Sort Article Order</span>
      <div><BR>&nbsp;</div>
  	<div class="contentbox">

    				<?php if(!empty($articles)){ ?>
					<?php foreach($articles as $article){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
            <div class="row <?php echo $class; ?>">
                  <div class="col-sm-3">
                  <?php if($article->displayme == 1){ ?>
                 <img src='../img/tick20.png'> Display on Online CV/Resume
                <?php } else { ?>
                 <img src='../img/wrong20.png'> Not displaying on Online CV/Resume
                 <?php } ?><BR>                    
              <strong><?php echo $article->company; ?></strong><BR>
                    <?=$article->name?><BR>
                    <?=$article->created?>          
                  </div>
                  <div class="col-sm-9">
                  <?= $this->Form->postLink(__('Delete'), ['plugin'=>null, 'controller'=>'article', 'action' => 'deletearticle', $article->id], ['confirm' => __('Are you sure you want to delete this article:   {0}?', $article->name), 'class' => 'btn btn-danger btn-xs float-right']) ?>
                  <span onClick="sendajax('/article/edit/<?php echo $article->id; ?>')" class="btn btn-primary btn-xs float-right">Edit</span>
                    <h3><?php echo  $article->name; ?></h3>
                    <?php echo $article->short; ?>
                  </div>
              </div>	
					<?php } } ?>
    </div>				
</div>
</div>