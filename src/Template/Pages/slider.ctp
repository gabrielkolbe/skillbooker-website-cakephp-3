  	<!-- search slider -->
		<div class="border_box slider_box">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php
				$count = 1;
					if(!empty($sliderimage)){
						foreach($sliderimage as $sliderarray => $images){

            $image = '/img/sliderimg/'.$images['ImageGallery']['image'];
            $title = $images['ImageGallery']['title'];                        
                                    
					?>		
					<div class="item <?php echo ($count==1) ? 'active' : ''; ?>">
						<?php echo $this->Html->image($image,array('alt' =>'Candidate questions','title' => 'Candidate tests'));	?>
						<div class="carousel-caption-employer">
							<h2 style='width:352px!important'><?php echo $title; ?></h2>
						</div>
					</div>	

					<?php	
					$count++;					
						}
					}
				 ?>
				</div> <!-- close div -->

			</div> <!-- close div -->
		</div>  <!-- close div -->   	<!-- search slider -->