<div class="row">
	<div class="col-md-12">  
   <?= $this->Html->link('Add Image', ['action' => 'add'], ['class' => 'btn btn-primary float-right'] ) ?>

 <legend>Images</legend>

  <?php if (!empty($images)): ?>
    <div class="row">
      <?php foreach ($images as $image): ?>
          <div class="col-md-2">
<?php          
          echo $this->Html->image('postcard_'.$image->name, [
          'alt' => $image->alt,
          'class' => 'thumbnail',
          'style' => 'width:100%; height:auto',
          'url' => ['controller' => 'Images', 'action' => 'view', $image->id]
      ]);
?>
<?php if($image->showphotowall == 0){ echo $this->Html->link(__('Show'), ['action' => 'showhide', 'show_'.$image->id], ['class' => 'btn btn-success btn-xs']);  } else {   } ?> <?= $this->Form->postLink(__('D'), ['action' => 'delete', $image->id], ['confirm' => __('Are you sure you want to delete this image?', $image->id), 'class' => 'btn btn-danger btn-xs']) ?><BR> 
<small>width:<?= $image->width ?> - height:<?= $image->height ?></small><BR>
<small><?= h($image->type) ?></small><BR>
 
               
                </div>
            <?php endforeach; ?>
  </row>
  <?php endif; ?>