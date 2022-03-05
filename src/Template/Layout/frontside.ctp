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
        'modalajax',
         'adminlte_app'              
        ]) ?> 
 

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
      

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
  <div class="container-fluid container-fluid-spacious">
  <?php echo $this->element('modal/modal'); ?>
    
    <div class="row">
        <div class="col-sm-2 sidebar bigger480">
            <?= $this->element('front/sidebar') ?>
        </div>
          
        <div class="col-sm-10 mainbar">
        <?= $this->element('front/topside') ?>
          <div class="contentsection">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Flash->render() ?>
              <div id="spinner" class=""></div>
              <?= $this->fetch('content') ?>
          </div>
        </div>                        
    </div>

</div>
             
<?= $this->fetch('scriptBottom') ?>

    <?= $this->Html->script([
        'chart',
        'tablesorter.min',
        'toolkit',
        'cbpAnimatedHeader',
        'application'
    ]) ?>    

    </body>
</html>
