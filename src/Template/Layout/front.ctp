<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
if(isset($pagetitle)){
echo $pagetitle; 
} else {
echo DEFAULT_PAGETITLE;
}   
?>
</title>
    <meta name="description" content="
<?php 
if(isset($pagedescription)){
echo $pagedescription; 
} else {
echo DEFAULT_SEO_DESCRIPTION;
}   
?>    
- <?= SITE ?>"/>
    
    <?php if(!empty($taglist)) { ?>
    <meta name="keywords" content="<?= $taglist ?>"/>
    <?php } else { ?>
    <meta name="keywords" content="<?= DEFAULT_SITE_KEYWORDS ?>"/>
    <?php } ?>

    <?= $this->Html->meta('icon') ?> 
    
    <?= $this->Html->css([
        'bootstrap.css',
        'skillbooker',
        'font-awesome-4.6.3/css/font-awesome.min',
    ]) ?>
    
    <link rel="sitemap" href="https://www.skillbooker.com/files/rss_projects.xml"/>
    <link rel="sitemap" href="https://www.skillbooker.com/files/rss_software.xml"/>
    <link rel="sitemap" href="https://www.skillbooker.com/files/rss_questions.xml"/>
    <link rel="sitemap" href="https://www.skillbooker.com/files/rss_jobs.xml"/>
    <link rel="sitemap" href="https://www.skillbooker.com/files/rss_tutorials.xml"/>
    <link rel="sitemap" href="https://www.skillbooker.com/files/rss_expiredjobs.xml"/>
    
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

<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-386765-66"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-386765-66');
</script>


</head> 
    <body class="">

<?php echo $this->element('modal/modal'); ?>
<header>
<?php echo $this->element('front/topbar'); ?>
<?php echo $this->element('front/logobar'); ?>
</header>
<!-- mid start -->
<div class="middlesection">
  <div class="container">
  <?= $this->Flash->render('auth') ?>
    <?= $this->Flash->render() ?>
    <div class="contentsection">
    <div id="spinner" class=""></div>
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
