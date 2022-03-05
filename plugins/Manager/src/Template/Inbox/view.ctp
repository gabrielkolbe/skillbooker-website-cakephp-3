<div class="row">
	<div class="col-md-12">

<?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete',$contactHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactHistory->id), 'class' => 'btn btn-danger float-right marginleft10'] );  ?> 
<?php echo $this->Html->link('Edit Contact History', ['action' => 'edit', $contactHistory->id], ['class' => 'btn btn-warning float-right'] );  ?>

<BR><BR>

    <h3><?= h($contactHistory->name) ?></h3>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($contactHistory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($contactHistory->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tel') ?></th>
            <td><?= h($contactHistory->tel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($contactHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($contactHistory->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($contactHistory->message)); ?>
    </div>
</div>
