<H1>Select a template</H1>
<h4>Select a template and populate your project then edit your project</h4>
<BR><BR>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'projects','action' => 'inserttemplateaction']]); ?>
<?php  echo $this->Form->hidden('id', ['value'=>$id]); ?>

<select name="template" class="form-control" id="template">
<option value="">Select a template >></option>
<?php foreach ($templates as $template): ?>
  <option value="<?= $template->slug; ?>"><?= $template->name; ?></option>
<?php endforeach; ?>
</select>

<?= $this->Form->button(__('Populate New Project'), ['id'=>'submit', 'class'=>'btn btn-primary float-right']) ?>
<?php  echo $this->Form->end(); ?>
<BR><BR>