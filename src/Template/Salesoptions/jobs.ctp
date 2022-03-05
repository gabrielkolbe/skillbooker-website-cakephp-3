
	<style>
		.price-container,
		.price-container:before,
		.price-container:after,
		.price-container .price,
		.price-container .price:before,
		.price-container .price:after {
			height: 4em;
			width: 4em;
			background: #ffa500 top left no-repeat;
			background-size: 4em;
		}
		
		.price-container:before,
		.price-container:after,
		.price-container .price:before,
		.price-container .price:after {
			content: "";
			position: absolute;
		}
		
		.price-container {
			position: relative; /* Context */
      height: 4em;
			width: 4em;
			-webkit-transform: rotate(-45deg);
			  -moz-transform: rotate(-45deg);
			   -ms-transform: rotate(-45deg);
			    -o-transform: rotate(-45deg);
			       transform: rotate(-45deg);
		}
		
		.price-container:before {
			top: 0;
			left: 0;
			-webkit-transform: rotate(-30deg);
			  -moz-transform: rotate(-30deg);
			   -ms-transform: rotate(-30deg);
			    -o-transform: rotate(-30deg);
			       transform: rotate(-30deg);
		}
		
		.price-container:after {
			top: 0;
			left: 0;
			-webkit-transform: rotate(-15deg);
			  -moz-transform: rotate(-15deg);
			   -ms-transform: rotate(-15deg);
			    -o-transform: rotate(-15deg);
			       transform: rotate(-15deg);
		}
		
		.price-container .price {
			padding: .5em 0em;
			height: 4em; /* height minus padding */
			position: absolute;
			bottom: 0;
			right: 0;
			-webkit-transform: rotate(45deg);
			  -moz-transform: rotate(45deg);
			   -ms-transform: rotate(45deg);
			    -o-transform: rotate(45deg);
			       transform: rotate(45deg);
			z-index: 1; /* important so the text shows up */
		}
		
		.price-container .price:before {
			top: 0;
			left: 0;
			-webkit-transform: rotate(60deg);
			  -moz-transform: rotate(60deg);
			   -ms-transform: rotate(60deg);
			    -o-transform: rotate(60deg);
			       transform: rotate(60deg);
		}
		
		.price-container .price:after {
			top: 0;
			left: 0;
			-webkit-transform: rotate(75deg);
			  -moz-transform: rotate(75deg);
			   -ms-transform: rotate(75deg);
			    -o-transform: rotate(75deg);
			       transform: rotate(75deg);
		}
			
		.price-container .price span {
			position: relative;
			z-index: 100;
			display: block;
			text-align: center;
			color: #fff;
			font: 1em/1.1em Sans-Serif;
			text-transform: uppercase;
		}
		
		.price-container .price span.number {
		  font-weight: bold;
		  font-size: 2.0em;
		  line-height: .9em;
		  color: #fff;
		}	

	</style>
  
<div class="row">
  <div class="col-sm-12">
    <BR>
  <h1>Job Listing Cost</h1>
  <h2>Please select an Option</h2>
  <p>When you list a job you can keep it online as long as you like, You can add skills and receive applications from candidates</p>
   <p><img src="/img/paypal2.jpg" width="130px"> &nbsp;Paypal is the only payment method currently available</p>
  </div>  
                             
<?php	if(!empty($salesoptions)){ 
foreach($salesoptions as $sale) { ?>
<div class="col-sm-4">
<BR>
<?php if($sale->savevalue > 0){ ?>
 <div class="contentbox">
<?php if($sale->price < 1){} else {
  if (!empty($this->request->session()->read('Auth.User.id'))) { 
    echo $this->Html->link('Cost $'.$sale->price, ['plugin' => null, 'controller' => 'payments', 'action' => 'credit', $sale->id ], ['class' => 'btn btn-primary float-right']); 
  } else {
    echo $this->Html->link('Cost $'.$sale->price, ['plugin' => null, 'controller' => 'users', 'action' => 'register' ], ['class' => 'btn btn-primary float-right']);
  }
} ?>
    <div class="price-container">
		  <div class="price">
		    <span class="label">Save</span>
		    <span class="number"><?php echo $sale->savevalue; ?>%</span>
		  </div>
		</div>
<BR>
			<h2><?php echo $sale->name; ?></h2>
      <BR>
      <?php echo $sale->description; ?><BR>			
</div>
</div>
<?php } else { ?>
<div class="contentbox">
<?php if($sale->price < 1){} else { 
  if (!empty($this->request->session()->read('Auth.User.id'))) { 
    echo $this->Html->link('Cost $'.$sale->price, ['plugin' => null, 'controller' => 'payments', 'action' => 'credit', $sale->id ], ['class' => 'btn btn-primary float-right']); 
  } else {
    echo $this->Html->link('Cost $'.$sale->price, ['plugin' => null, 'controller' => 'users', 'action' => 'register' ], ['class' => 'btn btn-primary float-right']);
  }
} ?>
<BR>
			<h2><?php echo $sale->name; ?></h2>
      <BR>
      <?php echo $sale->description; ?><BR>
      <BR><BR>			
</div>
</div>
<?php	} } } ?> 

  </div>