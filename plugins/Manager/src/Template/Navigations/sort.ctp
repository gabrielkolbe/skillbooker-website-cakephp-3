<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    //Helper function to keep table row from collapsing when being sorted
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index)
        {
          $(this).width($originals.eq(index).width())
        });
        return $helper;
    };

    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i + 1);
        });
    };

$("#sort tbody").sortable({
    helper: fixHelperModified,
    stop: updateIndex
}).disableSelection();

});

//Renumber table rows
function renumber_table(tableID) {
    $(tableID + " tr").each(function() {
        count = $(this).parent().children().index($(this)) + 1;
        $(this).find('.priority').html(count);
    });
}
</script>
<style>
.sorttxt { cursor: move;}

.ui-sortable tr {
    cursor:pointer;
}    
.ui-sortable tr:hover {
    background:rgba(244,251,17,0.45);
}
</style>


<div class="row">
	<div class="col-md-12">
  <legend>Sort Tab Order</legend>
  <?php if(!empty($tabs)) { ?>
    <?= $this->Form->create($tabs) ?>
    <table class="table table-striped grid" align="center" border="0" cellspacing="0" cellpadding="0"  id="sort">
        <thead>
            <tr>
                <th width="5%"  scope="col"> </th>
                <th width="45%"  scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th width="50%" scope="col"><?= $this->Paginator->sort('slug') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php 
             $i = 1; 
            foreach ($tabs as $tab){ ?>
               
               <tr class="sorttxt">
                  <td class="index"><?php echo $i; ?>
                  </td>
                <input type="hidden" name="tabid[]" value="<?= $tab->id ?>"> 
                  <td><?= h($tab->title) ?></td>
                  <td><?= h($tab->slug) ?></td>
               </tr>

				<?php $i++; } ?>
        </tbody>
    </table>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    <?php } ?>
	</div>
</div>
