<?php $this->Html->script('/js/ckeditor/ckeditor', ['block' => true]); ?>
<?php $this->Html->script('/jquery-validation/dist/jquery.validate.min.js', ['block' => true]); ?>
<script type="text/javascript">
$(document).ready(function(){

    $('#software-category-id').change(function(){  
    $.ajax({
         type : "POST",
                url  : ('/softwares/getfeatures/') + $("#software-category-id option:selected").val(),
                success : function(opt){
                        document.getElementById('features').innerHTML = opt; 
                         
                    }
            })
            }); 
  

});

</script>

<script type="text/javascript">

$(document).ready(function() {

var text_max = 200;
$('#counter').html(text_max + ' characters remaining');

$('.cke_editable').keyup(function() {
    var text_length = $('.cke_editable').val().length;
    var text_remaining = text_max - text_length;

    $('#counter').html('<strong>' + text_remaining + '</strong>');
});

});

</script>


<script>

	$().ready(function() {

		// validate signup form on keyup and submit
		$("#addsoftware").validate({
			rules: {
        price: {
					required: true,
					number: true
				},
				name: {
					required: true,
					minlength: 3
				},
				'software_deployment_ids[]': {
                required: true
        },
        'software_support_ids[]': {
                required: true
        },
        'software_demo_ids[]': {
                required: true
        },
        'software_training_ids[]': {
                required: true
        },
        'software_feature_ids[]': {
                required: true,
                minlength: 2
        },
        
				software_pricetype_id: "required",
        pricedisplay: "required",
        demoavailable: "required",
        freeversion: "required",
        freetrail: "required",
        software_numberemployee_id: "required",
        software_numberuser_id: "required",
        software_support_ids: "required",
        software_demo_ids: "required",
        software_training_ids: "required",
        software_feature_ids: "required",
        short_description: "required",
        long_description: "required",
        
			},
			messages: {
				price: {
					required: "Please insert price",
					number: "Only numbers allowed"
				},
				name: {
					required: "Please give it a name",
					minlength: "Software name must be at least 2 characters"
				},
				'software_deployment_ids[]': {
                required: "You must check at least 1 box"
        },
        	'software_deployment_ids[]': {
                required: "You must check at least 1 box"
        },
        	'software_support_ids[]': {
                required: "You must check at least 1 box"
        },
        	'software_demo_ids[]': {
                required: "You must check at least 1 box"
        },
        	'software_training_ids[]': {
                required: "You must check at least 1 box"
        },
        	'software_feature_ids[]': {
                required: "Select a Software Category to display features, please check at least 1 box",
                maxlength: "Check minimum {0} boxes"
        },
        priceperuser: "required",
        demoavailable: "required",
        freeversion: "required",
        freetrail: "required",
        software_numberemployee_id: "required",
        software_numberuser_id: "required",
        software_deployment_ids: "required",
        software_support_ids: "required",
        software_demo_ids: "required",
        software_training_ids: "required",
        software_feature_ids: "required",
        short_description: "required",
        long_description: "required",
        software_pricetype_id: "required",
        pricedisplay: "required"
			},
      errorPlacement: function(error, element) {
				if (element.is(":radio")) {
					error.appendTo(element.parent());
        } else if(element.is(":checkbox")) {
            error.appendTo(element.parent());
        } else {
          error.insertAfter(element);
        }

			},
      
		});

	});
  

  
  
	</script>
<style>

	label.error {
		margin-left: 5px;
    margin-top: 10px;
		width: auto;
		display: inline;
    border:2px solid red;
    padding:5px;
	} 
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
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <fieldset> 
         <BR>
         <span class="large-legend">Software Name</span> 
        <?php echo $this->Form->input('name', ['class'=>'form-control', 'label' => false, 'required' => true]); ?>

<div class="row">
 <div class="col-md-12"><BR></div>
<div class="col-md-12">
<span class="large-legend">Price & Cost</span> 
</div>
<BR><BR>
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
    <?php echo $this->Form->input('pricing_url', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>


  </div>
   <div class="col-md-6 col-sm-6 col-xs-6">
    Display Instead <strong>'Available on request'</strong> <input name="pricedisplay" value="1" type="radio"> Yes  <input name="pricedisplay" value="0" type="radio"> No
      <BR><BR>
   <strong>Price Period</strong><BR>
       <?php 
       foreach($softwarePricetypes as $id => $name) {
        echo '<input name="software_pricetype_id" value="'.$id.'" type="radio"> '.$name.' &nbsp;  ';
       }
       ?>
     <BR><BR><strong>Price Per User?</strong>
    <input name="priceperuser" value="1" type="radio" > Yes &nbsp;
    <input name="priceperuser" value="0" type="radio" > No
  </div>
 <div class="col-md-12"><BR><BR></div>
  <div class="col-md-12">
    <strong>Demo Available?</strong>
    <input name="demoavailable" value="1" type="radio" > Yes &nbsp;
    <input name="demoavailable" value="0" type="radio" > No
    <BR>
     <?php echo $this->Form->input('demo_url', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>
    </div>
  <div class="col-md-12">
    <BR><strong>Free Version?</strong>
    <input name="freeversion" value="1" type="radio" > Yes &nbsp;
    <input name="freeversion" value="0" type="radio" > No
        <BR>
     <?php echo $this->Form->input('freeversion_url', ['class'=>'form-control', 'type' => 'text', 'label' => false, 'placeholder'=>'http://www.']); ?>

  </div>
  <div class="col-md-12">
    <BR><strong>Free Trail?</strong>
    <input name="freetrail" value="1" type="radio" > Yes &nbsp;
    <input name="freetrail" value="0" type="radio" > No
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
  <div class="col-md-12">
   <BR><strong>Image to display on listing</strong>
    <BR>
   <?php echo $this->Form->input('theimage', ['type' => 'file',  'class'=>'form-control', 'label' => false]); ?>
  </div>

</div>

<div class="col-md-12">.<BR><BR>.</div>
        <span class="large-legend">Select a Software Category</span>
        <?php echo $this->Form->input('software_category_id', ['options' => $softwareCategories, 'class'=>'form-control', 'label' => false, 'required' => true, 'empty' => 'Select a Category >>' ]); ?>
<div class="col-md-12">.<BR><BR>.</div>
<span class="large-legend">Target Market</span>
<BR><BR>
<div class="col-md-12">
	<div style="display: inline-block;">
  <strong>How many employees does the potential customer have?</strong><BR>
       <?php 
       foreach($softwareNumberemployees as $id => $name) {
        echo '<input name="software_numberemployee_id" value="'.$id.'" type="radio"> '.$name.' &nbsp;  ';
       }
       ?>
  </div>
<div class="col-md-12"><BR></div>
  <div style="display: inline-block;">
    <strong>How many users does the potential customer have?</strong><BR>
       <?php 
       foreach($softwareNumberusers as $id => $name) {
        echo '<input name="software_numberuser_id" value="'.$id.'" type="radio"> '.$name.' &nbsp;  ';
       }
       ?>
  </div>
</div>
<div class="col-md-12"><BR><BR></div>

  <div class="col-md-6 col-sm-6 col-xs-6">
    <strong>How will the software be deployed?</strong><BR><BR>
       <?php 
       foreach($softwareDeployments as $id => $name) {
        echo '<input name="software_deployment_ids[]" id="deployed" value="'.$id.'" type="checkbox"> '.$name.'<BR>';
       }
       ?>
  </div>
  <div class="col-md-6 col-sm-6">
    <strong>What support are available?</strong><BR><BR>
       <?php 
       foreach($softwareSupports as $id => $name) {
        echo '<input name="software_support_ids[]" value="'.$id.'" type="checkbox"> '.$name.'<BR>';
       }
       ?>
    </div>
    <div class="col-md-12">.<BR><BR>.</div>
  <div class="col-md-6 col-sm-6">
    <strong>What demostration options are available?</strong><BR><BR>
       <?php 
       foreach($softwareDemooptions as $id => $name) {
        echo '<input name="software_demo_ids[]" value="'.$id.'" type="checkbox"> '.$name.'<BR>';
       }
       ?>
  </div>
  <div class="col-md-6 col-sm-6">
    <strong>What training are provided with the price?</strong><BR><BR>
       <?php 
       foreach($softwareTrainings as $id => $name) {
        echo '<input name="software_training_ids[]" value="'.$id.'" type="checkbox"> '.$name.'<BR>';
       }
       ?>
  </div>
  
  <div class="col-md-12"><BR><BR><span class="large-legend">Description</span><BR><BR></div>
  
    <div class="col-md-12 col-sm-12">
    <strong>Which features does your software have?</strong><BR><BR>
       <div id="features"><input name="software_feature_ids[]" value="0" type="checkbox" class="hideme"> </div>
  </div>
  <div class="col-md-12">.<BR><BR>.</div>
 <strong>A short description, characterising the most important characteristics? <BR>( used: <span id="counter"> </span> )</strong>
 <?php  echo $this->Form->input('short_description', ['class'=>'form-control validate[blockscript] ckeditor', 'label' => false]); ?>
 <BR><BR><strong>A long description, please provide as much detail as possible?</strong>
  <?php echo $this->Form->input('long_description', ['class'=>'form-control  validate[blockscript] ckeditor', 'label' => false]); ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
    </div>
</div>
</div>

