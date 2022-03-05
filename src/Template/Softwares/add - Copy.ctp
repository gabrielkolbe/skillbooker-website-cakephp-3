<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>

<script type="text/javascript">
$(document).ready(function(){

    $('#software-category-id').change(function(){  
    $.ajax({
         type : "POST",
                url  : ('/softwares/getfeatures/') + $("#software-category-id option:selected").val(),
                success : function(opt){
                        document.getElementById('features').innerHTML = opt;
                        $('#displayfeatures').remove(); 
                         
                    }
            })
            }); 
});

</script>
<style>

.hideme {
    position:fixed;
    bottom:0;
    right:0;
}
	</style>

<div class="row">
	<div class="col-md-12">
  <div class="contentbox padding15">
    <?= $this->Form->create($software, ['enctype' => 'multipart/form-data', 'id' => 'addsoftware']) ?>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right submit']) ?>

    <fieldset> 
<div class="row">
  <div class="col-md-12">
         <span class="large-legend">Software Name</span> 
        <?php echo $this->Form->input('name', ['id'=>'software_name', 'class'=>'form-control', 'label' => false, 'required' => true]); ?>

 <div class="col-md-12"><BR></div>
 
  <div class="col-md-12">
   <span class="large-legend">Image/Logo</span><BR> 
   Image to display on listing, only jpeg', 'jpg', 'png', 'gif', 'bmp' are allowed
   <div id="imageerror" style="color:red;"></div>
    <BR>
   <?php echo $this->Form->input('theimage', ['type' => 'file',  'class'=>'form-control', 'label' => false]); ?>
  </div>
  
   <div class="col-md-12"><BR></div>
   
     <div class="col-md-12">
        <span class="large-legend">Select a Software Category</span>
        <?php echo $this->Form->input('software_category_id', ['options' => $softwareCategories, 'class'=>'form-control', 'label' => false, 'required' => true, 'empty' => 'Select a Category >>' ]); ?>
  </div>
  
   <div class="col-md-12"><BR></div>
  
  <div class="col-md-12">
      <span class="large-legend">Price & Cost</span> 
  </div>
  
  <div class="col-md-12"><BR></div>

 <div class="col-md-6 col-sm-6 col-xs-6">
 <strong>Starting Price</strong><BR>
 
   <div style="display: inline-block;">
      <?php echo $this->Form->input('currency_id', ['class'=>'form-control', 'label' => false, 'style' => 'width:100px;', 'empty'=>'Select Paid Currency >>', 'required' => true]); ?>
  </div>
   <div style="display: inline-block;">
        <?php echo $this->Form->input('price', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'style' => 'width:100px;', 'placeholder'=>'Numbers only', 'required' => true]); ?>
  </div>

    <BR>
    <strong>URL to price information</strong><BR>
    <?php echo $this->Form->input('pricing_url', ['id'=>'software_pricingurl', 'class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>

  </div>
  
   <div class="col-md-6 col-sm-6 col-xs-6">
    Display Instead <strong>'Available on request'</strong> 
    <?php echo $this->Form->radio('pricedisplay', ['No','Yes']); ?>
      <BR><BR>
   <strong>Price Period</strong><BR>
   <?php echo $this->Form->radio('software_pricetype_id', $softwarePricetypes); ?>
     <BR><BR><strong>Price Per User?</strong>
     <?php echo $this->Form->radio('priceperuser', ['No','Yes']); ?>
  </div>
  
 <div class="col-md-12"><BR></div>
 
  <div class="col-md-12">
    <strong>Demo Available?</strong>
    <?php echo $this->Form->radio('demoavailable', ['No','Yes']); ?>
    <BR>
     <?php echo $this->Form->input('demo_url', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>
    </div>
    
  <div class="col-md-12">
    <BR><strong>Free Version?</strong>
    <?php echo $this->Form->radio('freeversion', ['No','Yes']); ?>
        <BR>
     <?php echo $this->Form->input('freeversion_url', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>
  </div>
  
  <div class="col-md-12">
    <BR><strong>Free Trail?</strong>
    <?php echo $this->Form->radio('freetrail', ['No','Yes']); ?>
    <BR>
     <?php echo $this->Form->input('trail_url', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>
  </div>
  
  <div class="col-md-12">
    <BR><strong>Signup or Registration URL</strong>
    <BR>
     <?php echo $this->Form->input('signup_url', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>
  </div>
  
    <div class="col-md-12">
    <BR><strong>Customer Referal URL</strong>
    <BR>
     <?php echo $this->Form->input('customer_url', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>
  </div>
  
  <div class="col-md-12"><BR></div>
  
  <div class="col-md-12">
      <span class="large-legend">Details</span>
  </div>
  
  <div class="col-md-12"><BR></div>
     
  <div class="col-md-6 col-sm-6 col-xs-6">
    <strong>How will the software be deployed?</strong><BR><BR>
       <?php   
       echo $this->Form->input('software_deployment_ids', ['label' => false, 'options' => $softwareDeployments, 'multiple' => 'checkbox']); 
       ?>
  </div>
  <div class="col-md-6 col-sm-6">
    <strong>What support are available?</strong><BR><BR>
    <?php       
      echo $this->Form->input('software_support_ids', ['label' => false, 'options' => $softwareSupports, 'multiple' => 'checkbox']); 
    ?>
    </div>
    <div class="col-md-12">.<BR><BR>.</div>
  <div class="col-md-6 col-sm-6">
    <strong>What demostration options are available?</strong><BR><BR>
    <?php      
      echo $this->Form->input('software_demo_ids', ['label' => false, 'options' => $softwareDemooptions, 'multiple' => 'checkbox']); 
    ?>
  </div>
  <div class="col-md-6 col-sm-6">
    <strong>What training are provided with the price?</strong><BR><BR>
    <?php     
      echo $this->Form->input('software_training_ids', ['label' => false, 'options' => $softwareTrainings, 'multiple' => 'checkbox']); 
    ?>
  </div>
  
  
  <div class="col-md-12"><BR><BR><span class="large-legend">Description</span><BR><BR></div>
   
 <div id="displayfeatures">
    <strong>Which features does your software have?</strong><BR><BR>
    <?php
       $softwarearray = $software['software_features'];
       $softwarearray = explode(',',$softwarearray);
      if(!empty($softwareFeatures)) {        
      echo $this->Form->input('software_feature_ids', ['label' => false, 'options' => $softwareFeatures, 'multiple' => 'checkbox',  'default' => $softwarearray]); 
      }
    ?>
    </div>
       <div id="features"><input name="software_feature_ids" value="0" type="checkbox" class="hideme"> </div>
  </div>
  <div class="col-md-12"><BR><BR></div>

 <BR><BR><strong>A long description, please provide as much detail as possible?</strong><BR>
 <p>The first 200 characters will be used on the listing page</p>
  <?php echo $this->Form->input('long_description', ['class'=>'form-control  validate[blockscript] ckeditor', 'label' => false]); ?>
    </fieldset>

    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right submit']) ?>

    <?= $this->Form->end() ?>
    </div>
</div>
</div>
<script type="text/javascript">

$("#theimage").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $( "#imageerror" ).append( "Only formats are allowed : "+fileExtension.join(', ') );
            $("#theimage").val("");
        }
    });

</script>
