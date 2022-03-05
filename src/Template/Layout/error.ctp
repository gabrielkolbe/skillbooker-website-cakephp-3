<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        'bootstrap.css',
        'skillbooker',
        'font-awesome-4.6.3/css/font-awesome.min',
    ]) ?>
    
    <?= $this->Html->script([
    'jquery.min',        
    'jquery.form',
    'modalajax'              
    ]) ?> 

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
<script type="text/javascript">

$(window).scroll(function () {
if( $(window).width() > 1000){
	if ($(this).scrollTop() > 50) {
		$(".topname").show(300);
    $(".logo_bar").hide(300);
	} else {
   $(".topname").hide(300);
   $(".logo_bar").show(300);
	}
  }
});

</script>

</head> 
<body>
<?php echo $this->element('front/header'); ?>
<!-- mid start -->
<div class="middlesection">
  <div class="container">
    <?= $this->Flash->render() ?>
    <div class="contentsection">
  <h2>Oops, this page has moved please try and find it</h2>
    <?= $this->fetch('content') ?>
    </div>
  </div>
</div>
<?php echo $this->element('front/footer'); ?> 
                             
  
</div>
             
<?= $this->fetch('scriptBottom') ?>

    <?= $this->Html->script([
      //  'chart',
      //  'tablesorter.min',
        'toolkit',      //toolkit is for dropdown box in menu
    //    'cbpAnimatedHeader',
      //  'application'
    ]) ?>     

    </body>
</html>