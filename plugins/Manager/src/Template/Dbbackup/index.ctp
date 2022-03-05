<style>
.float-right {
 margin-top:10px;
 float:right;
}

.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #999!important;
}

</style>
<div class="row">
<div class="col-md-12">
<div class="well box blurred-bg tinted">
  <h1>Database backup and restore from Dump</H1>
</div>
</div>

	<div class="col-md-6">
  <div class="well box blurred-bg tinted">
    <H3>Restore from SQL dump</H3>
    <?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'dbbackup','action' => 'restorefromdump']]); ?>
    <?php echo $this->Form->input('database_id', ['options' => $dumps, 'class'=>'form-control', 'label' => false, 'default' => '', 'empty'=>'Select a database >>']); ?>
    <?php echo $this->Form->button(__('Submit'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']); ?>
    <?php echo $this->Form->end(); ?>
    <BR>
  </div>
 </div>

<div class="col-md-6"> 
 <div class="well box blurred-bg tinted"> 
   <H3>Back up to SQL Dump</H3>
    <?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'dbbackup','action' => 'backuptodump']]); ?>
    <?php echo $this->Form->input('savedname', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'value'=>$savedname, 'required' => true]); ?>
    <?php echo $this->Form->button(__('Submit'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']); ?>
     <BR>
  </div>
</div>

<div class="col-md-12"> 
 <div class="well box blurred-bg tinted"> 
      <h1>Database backup and restore from SQL files</H1>
  </div>
</div>

<div class="col-md-6"> 
 <div class="well box blurred-bg tinted"> 
  <H3>Restore from SQL files</H3>
  <?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'dbbackup','action' => 'restorefromfile']]); ?>
  <?php echo $this->Form->input('database_id', ['options' => $backups, 'class'=>'form-control', 'label' => false, 'default' => '', 'empty'=>'Select a database >>']); ?>
  <?php echo $this->Form->button(__('Submit'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']); ?>
  <?php echo $this->Form->end(); ?>
    <BR><BR>
  </div>
</div>

<div class="col-md-6"> 
 <div class="well box blurred-bg tinted">   
   <H3>Back up to SQL files</H3>
    <?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'dbbackup','action' => 'backuptofile']]); ?>
    <?php echo $this->Form->input('savedname', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'value'=>$savedname, 'required' => true]); ?>
    <?php echo $this->Form->button(__('Submit'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']); ?>
    <?php echo $this->Form->end(); ?>
     <BR>
  </div>
</div>

<div class="col-md-12"> 
 <div class="well box blurred-bg tinted"> 
<H3>Tables on sql files</H3>
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="70%" scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th width="15%" scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th width="15%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= h($entry->name) ?></td>
                <td><?php echo $entry->created; ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('restore table'), ['action' => 'restoretable', $entry->id], ['class' => 'btn btn-primary btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
        
        </div>
    </div>
</div>