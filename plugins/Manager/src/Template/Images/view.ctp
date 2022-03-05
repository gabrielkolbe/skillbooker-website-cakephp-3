<style>
.postimage {
width:300px;

}
</style>
<div class="row">
	<div class="col-md-12">

<?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete',$image->id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->id), 'class' => 'btn btn-danger float-right marginleft10'] );  ?> 


<BR><BR>

<?php if(!empty($image->name)) { echo $this->Html->image($image->name, ['class'=> 'postimage']); }   ?> 

<BR><BR>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name & Access') ?></th>
            <td>www.<?php echo DOMAIN; ?>/img/<?= h($image->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Width') ?></th>
            <td><?= h($image->width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($image->created) ?></td>
        </tr>
    </table>
    <div>
          <table class="table">
        <tr>
            <td>
            www.<?php echo DOMAIN; ?>/img/small_<?= h($image->name) ?><BR>
            <?php if(!empty($image->name)) { echo $this->Html->image('small_'.$image->name, ['class'=> 'thumbnailsmall']); }   ?>
            </td>
            <td>
            www.<?php echo DOMAIN; ?>/img/squared_<?= h($image->name) ?><BR>
            <?php if(!empty($image->name)) { echo $this->Html->image('squared_'.$image->name, ['class'=> '']); }   ?>
            </td>
            <td>
            www.<?php echo DOMAIN; ?>/img/postcard_<?= h($image->name) ?><BR>
            <?php if(!empty($image->name)) { echo $this->Html->image('postcard_'.$image->name, ['class'=> 'postimage']); }   ?>
            </td>
        </tr>

        </tr>
    </table>
    </div>
</div>
