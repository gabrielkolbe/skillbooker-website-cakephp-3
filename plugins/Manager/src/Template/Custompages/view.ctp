<div class="row">
	<div class="col-md-12">

<?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete',$custompage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $custompage->id), 'class' => 'btn btn-danger float-right marginleft10'] );  ?> 
<?php echo $this->Html->link('Edit Custompage', ['action' => 'edit', $custompage->id], ['class' => 'btn btn-warning float-right'] );  ?>

<BR><BR>

    <h3><?= h($custompage->title) ?></h3>

    <div class="row">
        <?= $custompage->body; ?>
    </div>
</div>
