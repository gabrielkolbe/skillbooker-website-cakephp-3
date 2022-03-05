
<div class="row">
	<div class="col-md-12">
<?= $this->Html->link(__('Sync Unscanned Jobs Content for Skills'), ['action' => 'jobcontentskills'], ['class' => 'btn btn-primary']) ?> <BR>
<?= $this->Html->link(__('Sync ALL Jobs Content for Skills'), ['action' => 'alljobcontentskills'], ['class' => 'btn btn-primary']) ?> <BR>
<?= $this->Html->link(__('Sync Job Skills to Distinct Job skills'), ['action' => 'syncdistinctjobskills'], ['class' => 'btn btn-primary']) ?> <BR>
<?= $this->Html->link(__('Sync Projects Skills to Distinct Project skills'), ['action' => 'syncdistinctprojectskills'], ['class' => 'btn btn-primary']) ?> <BR>
<?= $this->Html->link(__('Sync Industry Distinct'), ['action' => 'industrydistinct'], ['class' => 'btn btn-primary']) ?><BR>
<?= $this->Html->link(__('Sync Country Distinct'), ['action' => 'countrydistinct'], ['class' => 'btn btn-primary']) ?><BR>
<?= $this->Html->link(__('RSS Software'), ['action' => 'rsssoftwarexml'], ['class' => 'btn btn-primary']) ?><BR>
<?= $this->Html->link(__('RSS Jobs'), ['action' => 'rssjobxml'], ['class' => 'btn btn-primary']) ?><BR>
<?= $this->Html->link(__('RSS Tutorials'), ['action' => 'rsstutorialxml'], ['class' => 'btn btn-primary']) ?><BR>
<?= $this->Html->link(__('RSS Projects'), ['action' => 'rssprojectxml'], ['class' => 'btn btn-primary']) ?><BR>
<?= $this->Html->link(__('RSS Expired Jobs'), ['action' => 'rssexpiredjobsxml'], ['class' => 'btn btn-primary']) ?><BR>
</div>
</div>