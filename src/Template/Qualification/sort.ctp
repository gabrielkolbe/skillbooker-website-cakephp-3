<script>

var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
    });
    return $helper;
},
    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i + 1);
        });
    };

$("#sort tbody").sortable({
    helper: fixHelperModified,
    stop: updateIndex
}).disableSelection();

</script>
<style>
tr:nth-of-type(odd) { background-color: #fff; }
tr:nth-of-type(even) { background-color: #ccc; }
.sorttxt { cursor: move; line-height:1.5em;}
</style>

<H1>Sort Order of Employment</H1>
<?php echo $this->Form->create(null,  ['url' => ['plugin' => null,'controller' => 'qualification','action' => 'sortaction']]); ?>
<?= $this->Form->button(__('Save Order'), ['class'=>'btn btn-primary float-right']) ?> 
<table id="sort" class="grid" width="100%"> 

				<?php if(!empty($QA)){ ?>
        <tbody>					
          <?php
          $i = 1; 
            foreach($QA as $qualification){ ?>
               <tr class="sorttxt"><td class="index"><?php echo $i; ?></td>
               <td>
                <?php if($qualification->displayme == 1){$checked = 'checked';} else {$checked = '';} ?>
               <input type="checkbox" name="displayme[]" value="<?php echo $qualification->id; ?>" <?php echo $checked; ?>>
               </td>
               <td>
               <input type="hidden" name="id[]" value="<?php echo $qualification->id; ?>"> 
  								<strong><?php echo $qualification->name; ?></strong><BR>
                  <?php echo $qualification->from_date; ?> - <?php echo $qualification->to_date; ?>
               </td></tr>

					<?php $i++;
          } ?>

				<?php } ?>
      </tbody> 
</table>
<?php  echo $this->Form->end(); ?>