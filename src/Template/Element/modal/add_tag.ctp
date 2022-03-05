<div id="docsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add A Tag</h4>
      </div>
      <div class="modal-body">

    <?php echo  $this->Form->create($tag, ['url' => ['prefix' => 'admin', 'controller' => 'tags', 'action' => 'add']]) ?>    
        <fieldset>
 <div class="form-group">
       <?php  echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'placeholder'=>'Tag']); ?>
   </div>
        </fieldset>
      </div>
      <div class="modal-footer">
      <input type="submit" id="modal-form-submit" name="submit" class="btn btn-primary" />
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>