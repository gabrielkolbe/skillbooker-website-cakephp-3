<div class="row">
  
  <div class="col-xs-12 col-md-12">
    <h1 class="toph1">Software Market</h1>
  </div>
  
	<div class="col-xs-12 col-md-2">
    <div class="contentbox padding15">
  <h2>What would you like to see?</h2>
  
  <?php echo $this->Form->create('Softwares',['url'=>['plugin'=>null,'controller'=>'softwares','action'=>'index']]); ?>
  <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'softwaresearch']); ?>
  <?php echo $this->Form->input('searchword', ['class'=>'form-control', 'label' => false, 'placeholder'=>'e.g. Recruitment Software']);  ?>
  <?= $this->Form->submit('Go Search', ['class'=>'btn btn-primary btn-xs float-right']); ?>
  <?= $this->Form->end(); ?>
  <BR><BR>
    <div class="sideimg bigger768">
    <img src="/img/lego_305.jpg">
  </div>
     </div>
  </div>
  <div class="col-xs-12 col-md-7">
  <div class="contentbox padding15">  
  
    <legend><?= __('Software Categories') ?></legend>
    <BR>
<?php foreach ($categories as $category): ?>
<h2><?php echo '<a href="/softwares/category/'.$category->slug.'" class="hoverme">'.$category->name.'</a>'; ?></h2>
<?php endforeach; ?>
            

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, categories {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    
    </div>    
</div>

 <div class="col-xs-12 col-md-1">
    <ul class="vertical_list">
        <li class=""><a href="/softwares/getcategory/a">A</a></li>
        <li class=""><a href="/softwares/getcategory/b">B</a></li>
        <li class=""><a href="/softwares/getcategory/c">C</a></li>
        <li class=""><a href="/softwares/getcategory/d">D</a></li>
        <li class=""><a href="/softwares/getcategory/e">E</a></li>
        <li class=""><a href="/softwares/getcategory/f">F</a></li>
        <li class=""><a href="/softwares/getcategory/g">G</a></li>
        <li class=""><a href="/softwares/getcategory/h">H</a></li>
        <li class=""><a href="/softwares/getcategory/i">I</a></li>
        <li class=""><a href="/softwares/getcategory/j">J</a></li>
        <li class=""><a href="/softwares/getcategory/k">K</a></li>
        <li class=""><a href="/softwares/getcategory/l">L</a></li>
        <li class=""><a href="/softwares/getcategory/m">M</a></li>
        <li class=""><a href="/softwares/getcategory/n">N</a></li>
        <li class=""><a href="/softwares/getcategory/o">O</a></li>
        <li class=""><a href="/softwares/getcategory/p">P</a></li>
        <li class=""><a href="/softwares/getcategory/q">Q</a></li>
        <li class=""><a href="/softwares/getcategory/r">R</a></li>
        <li class=""><a href="/softwares/getcategory/s">S</a></li>
        <li class=""><a href="/softwares/getcategory/t">T</a></li>
        <li class=""><a href="/softwares/getcategory/u">U</a></li>
        <li class=""><a href="/softwares/getcategory/v">V</a></li>
        <li class=""><a href="/softwares/getcategory/w">W</a></li>
        <li class=""><a href="/softwares/getcategory/x">X</a></li>
        <li class=""><a href="/softwares/getcategory/y">Y</a></li>
        <li class=""><a href="/softwares/getcategory/z">Z</a></li>
    </ul>
  </div>

   <div class="col-xs-12 col-md-2">
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