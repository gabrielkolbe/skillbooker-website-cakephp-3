
<div class="row">
	<div class="col-md-10">
 <div class="contentbox padding15"> 

    <legend><?= __('Tutorials') ?></legend>
    
    <style>
.searchinput {
    width: 200px !important;
    margin-top:10px;
    margin-bottom:10px;
}
.searchbutton {
    border: 0px;
    float:right;
    margin-top: -30px;
    margin-right:10px;
}
</style>

   <div id="searchbox" style="width:250px;">         
                <?php
                    echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'tutorials','action' => 'list']]);
                    echo $this->Form->hidden('dosearch', ['value' => 'do']);
                    echo $this->Form->input('search', ['class' => 'searchinput', 'label' => '', 'placeholder' => 'Search']);
                    echo $this->Form->button('', ['class'=>'fa fa-search searchbutton']);
                    echo $this->Form->end(); 
              ?>
    </div>                
    <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hitcount', 'Viewed') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tutorials as $tutorial): ?>
            <tr>
                <td><a href="/tutorials/<?php echo $tutorial->slug; ?>" class = "hoverme"><?php echo $tutorial->name; ?></a></td>
                <td><?= $this->Number->format($tutorial->hitcount) ?></td>
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

<div class="col-sm-2">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- skillbooker vertical -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3625264154493537"
     data-ad-slot="4826439165"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
 </div>


</div>