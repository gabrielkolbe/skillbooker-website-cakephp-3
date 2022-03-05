<div class="row">
<BR>
<div class="col-xs-12 col-md-8">
    <h1 class="toph1"><?php echo '<a href="/category/'.$category->slug.'">'.$category->name.'</a>'; ?> - <?php echo $software->name; ?></h1>
</div>
<div class="col-md-3 bigger480">
    <?php echo $this->Form->create('Softwares',['url'=>['plugin'=>null,'controller'=>'softwares','action'=>'index']]); ?>
    <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'softwaresearch']); ?>
    <?php echo $this->Form->input('searchword', ['class'=>'form-control floatright', 'label' => false, 'placeholder'=>'Search Again']);  ?>
</div>
<div class="col-md-1 bigger480">
    <?= $this->Form->submit('Go', ['class'=>'btn btn-primary floatright']); ?>
    <?= $this->Form->end(); ?>
</div>
<div class="col-xs-12 col-md-12"><BR></div>

  <div class="col-xs-12 col-md-4">
  <div class="contentbox">
  
<?php if(empty($software->theimage)) { ?>
<img src="/img/squared_comingsoon.png" alt="comingsoon"  style="width:320px; border:1px solid #ccc;">
<?php } else { ?>
<img src="/img/software/postcard_<?= $software->theimage ?>" alt="<?= $software->name ?>" class="img-rounded softwareimg" >
<?php } ?>

<BR>
<h2>Software Details</h2>
<BR>

<table class="table table-striped">
<tbody>
<tr>
    <td><strong>Starting Price</strong></td>
    <td><?php if($software->pricedisplay == 1) { echo 'Available on request'; } else { echo $currency; echo ' '; echo $software->price; ?>/<?php echo $priceperiod; } ?></td>
</tr>
<tr>
    <td><strong>Free Version</strong></td>
    <td><?php if($software->freeversion == 1) { ?> Yes <img src="/img/tick20.png"> <?php } else { ?> No <img src="/img/wrong20.png"> <?php } ?></td>
</tr>
<tr>
    <td><strong>Free Trail</strong></td>
    <td><?php if($software->freetrail == 1) { ?> Yes <img src="/img/tick20.png"> <?php } else { ?> No <img src="/img/wrong20.png"> <?php } ?></td>
</tr>
<tr>
    <td><strong>Availble Demo</strong></td>
    <td><?php if($software->demoavailable == 1) { ?> Yes <img src="/img/tick20.png"> <?php } else { ?> No <img src="/img/wrong20.png"> <?php } ?></td>
</tr>

</tbody>
</table>

<table class="table table-striped">
<tbody>

<tr><td>&nbsp;</td></tr>
<tr><td><strong>Deployment</strong></td></tr>

    <?php
      $softwarearray = $software['software_deployment'];
       $softwarearray = explode(',',$softwarearray);
       
       foreach($softwareDeployments as $id => $name) {
         if(in_array($id,$softwarearray)) { 
          echo '<tr><td><img src="/img/tick20.png"> '.$name.'</td></tr>';
         } else {
          echo '<tr><td><img src="/img/wrong20.png"> '.$name.'</td></tr>';
         }
       }
?> 

<tr><td>&nbsp;</td></tr>
<tr><td><strong>Training</strong></td></tr>

    <?php
      $softwarearray = $software['software_training'];
       $softwarearray = explode(',',$softwarearray);
       
       foreach($softwareTrainings as $id => $name) {
         if(in_array($id,$softwarearray)) { 
          echo '<tr><td><img src="/img/tick20.png"> '.$name.'</td></tr>';
         } else {
          echo '<tr><td><img src="/img/wrong20.png"> '.$name.'</td></tr>';
         }
       }
?> 
<tr><td>&nbsp;</td></tr>

<tr><td><strong>Support</strong></td></tr>

    <?php
      $softwarearray = $software['software_support'];
       $softwarearray = explode(',',$softwarearray);
       
       foreach($softwareSupports as $id => $name) {
         if(in_array($id,$softwarearray)) { 
          echo '<tr><td><img src="/img/tick20.png"> '.$name.'</td></tr>';
         } else {
          echo '<tr><td><img src="/img/wrong20.png"> '.$name.'</td></tr>';
         }
       }
?> 
<tr><td>&nbsp;</td></tr>
</tbody>
</table>


  </div>
  
  </div>
	<div class="col-xs-12 col-md-8">
    <div class="contentbox padding15"> 
<div>
<?php
if(!empty($software->customer_url)) { echo '<a href="'.$software->customer_url.'" target="_blank" class="btn btn-inverse btn-xs float-right">Customer Referals</a>'; }
if(!empty($software->signup_url)) { echo '<a href="'.$software->signup_url.'" target="_blank" class="btn btn-inverse btn-xs float-right">Sign up</a>'; }
if(!empty($software->pricing_url)) { echo '<a href="'.$software->pricing_url.'" target="_blank" class="btn btn-inverse btn-xs float-right">Pricing</a>'; }
if($software->freetrail == 1) { if(!empty($software->trail_url)) { echo '<a href="'.$software->trail_url.'" target="_blank" class="btn btn-inverse btn-xs float-right">Free Trail</a>'; } } 
if($software->freeversion == 1) { if(!empty($software->freeversion_url)) { echo '<a href="'.$software->freeversion_url.'" target="_blank" class="btn btn-inverse btn-xs float-right">Free Version</a>'; } }
if($software->demoavailable == 1) { if(!empty($software->demo_url)) { echo '<a href="'.$software->demo_url.'" target="_blank" class="btn btn-inverse btn-xs float-right">Free Demo</a>'; } } 
?>
</div> 
    
<div>

<h2>Available Category Features</h2>
<?php if($software->software_features == 0) { echo '<p>Sorry, this information is not available</p>'; } else { ?>
<ul class="check-list  check-list-slim  features-check-list">
 <?php
      $softwarearray = $software['software_features'];
       $softwarearray = explode(',',$softwarearray);
       
       foreach($softwareFeatures as $id => $name) {
         if(in_array($id,$softwarearray)) {

          echo '<li class="ss-check"> '.$name.'</li>';
         } else {
          echo '<li class="ss-check disabledgrey"> '.$name.'</li>';
         }
       }
?>
</ul>
<?php } ?>
</div> 
<BR>
<h2>More Detail</h2>
<div class="description">
    <?= $software->long_description ?>
</div>
  </div>