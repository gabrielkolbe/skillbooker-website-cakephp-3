
<div class="row">
	<div class="col-md-12">
  
<?= $this->Html->link(__('New Event'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <legend><?= __('Events') ?></legend>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="10%" scope="col"> </th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Venue') ?></th>
                <th scope="col"><?= $this->Paginator->sort('places', 'Available Places') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attendants', 'Participants') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eventdate', 'Event Date') ?></th>
                <th width="20%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?php if(!empty($event->mainimage)) { echo $this->Html->image('small_'.$event->mainimage, ['class'=> 'thumbnailsmall']); }   ?></td>
                <td><?= h($event->title) ?></td>
                <td><?= h($event->venue['title']) ?></td>
                <td><?= $this->Number->format($event->places) ?></td>
                <td><?php if($event->attendants > 0 ) { echo $this->Html->link($event->attendants, ['controller' => 'Users', 'action' => 'attendees', $event->id]); } else { echo '0'; } ?></td>
                <td><?php $eventdate = $event->eventdate;
        echo $eventdate->i18nFormat('dd-MM-yyyy'); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Find Participants'), ['action' => 'find', $event->id], ['class' => 'btn btn-success btn-xs']) ?>
                    <?php if($event->attendants > 0 ) { echo $this->Html->link(__('Participants'), ['controller' => 'Users', 'action' => 'attendees', $event->id], ['class' => 'btn btn-info btn-xs']); } ?>
                    <BR><?= $this->Html->link(__('View'), ['action' => 'view', $event->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id), 'class' => 'btn btn-danger btn-xs']) ?>
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