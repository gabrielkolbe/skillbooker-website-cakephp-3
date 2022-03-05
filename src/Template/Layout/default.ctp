<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE ?> - <?= DEFAULT_PAGETITLE ?></title>
    <meta name="description" content="<?= DEFAULT_SEO_DESCRIPTION ?>"/>
    <meta name="keywords" content="<?= DEFAULT_SITE_KEYWORDS ?>"/>

    <?= $this->Html->meta('icon') ?>
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
    

    <?php echo $this->Html->css('toolkit-dark.css'); ?>

    <?= $this->Html->css([
        'application',
        'font-awesome-4.6.3/css/font-awesome.min',
    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
        <?= $this->Html->script([
        'jquery.min',
        'adminlte_app'
              
    ]) ?> 

      
  <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
   
</head>
<body> 
  <div class="container-fluid container-fluid-spacious">

    <div class="row">
      <?= $this->element('admin/topbar') ?>
        <div class="col-sm-2 sidebar">
            <?= $this->element('admin/sidebar') ?>
        </div>
        <div class="col-sm-10 content">   
            <?= $this->Flash->render('auth') ?>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        
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
      
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAILAPI ?>&callback=initMap">
    </script>
</body>
</html>
