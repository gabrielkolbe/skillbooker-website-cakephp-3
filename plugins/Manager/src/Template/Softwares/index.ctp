<style>
.red {
color:red;
}
.green {
color:green;
}
</style>
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Software'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Softwares') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('theimage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status', 'Approved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('features') ?></th>
                <th scope="col"><?= $this->Paginator->sort('twitter') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($softwares as $software): ?>
            <tr>
                <td>
                <?php if(empty($software->theimage)) { ?>
                <img src="/img/small_comingsoon.png" alt="comingsoon" style="width:50px;">
                <?php } else { ?>
                <a href="/softwares/view/<?= $software->slug ?>"><img src="/img/software/small_<?= $software->theimage ?>" alt="<?= $software->name ?>" class="img-rounded margin5" style="width:50px;"></a>
                <?php } ?>
                </td>
                <td><?= h($software->name) ?></td>
                <td><?= $this->Number->format($software->price) ?></td>
                <td><?php if($software->status == 1) { echo '<span class="green">approved</span>'; } else { echo '<span class="red">Waiting Approval</span>'; } ?></td>
                <td><?= h($software->software_features) ?></td>
                <td><?= $software->twitter ?></td>
                <td><?= h($software->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Twitter'), ['action' => 'totwitter', $software->id], ['class' => 'btn btn-info btn-xs']) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $software->slug], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $software->slug], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $software->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $software->slug), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
</div>