<div class="row">
    <div class="col-xs-12 col-sm-12">
    
        <div class="contentbox grey">
            <div class="row">
            
              <div class="col-sm-2">
               Searching:<small><?php echo $industry; ?></small>
                <span onClick="sendajax('/jobboard/jobs/changeindustrymodal/')" class="btn btn-primary btn-xs">Change</span><BR>
                  <small><?php echo $country; ?></small><BR>
  <span onClick="sendajax('/jobboard/jobs/changecountrymodal/')" class="btn btn-primary btn-xs">Change</span>
              </div>  
              
              <div class="col-sm-6">

               
  <?php echo $this->Form->create('Job',['url'=>['plugin'=>'Jobboard','controller'=>'jobs','action'=>'index']]); ?>
  <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'skillsearch']); ?>
  <input value="activate selector" id="activate_selectator4" type="button">
  
  <small>Start typing the skills you have</small>
    <select name="skill[]" multiple="multiple" class="select4" size="7" style="display: none;">
    <?php
    foreach($jobskillsdistinct as $key => $name){
      if(!empty($showskill_list)) {
        if (array_key_exists($key, $showskill_list)) { echo '<option value="'.$key.'" selected>'.$name.'</option>'; } else { echo '<option value="'.$key.'">'.$name.'</option>'; }
      } else {
        echo '<option value="'.$key.'">'.$name.'</option>';
      } 
    }
    
    ?>
     </select>
    
              </div>
              
              <div class="col-sm-2">
                 
<?php					

      $checkedval = '';
					foreach($jobtypeslist as $key => $jtype){
						
            if($key == $jobtype){
							$checkedval = $key;  
						}
                
      ?>	
           <div class="radio"><label>
						<?php
							echo $this->Form->radio('jobtype_id', [$key => false], ['hiddenField' => false, 'label' => false, 'value' =>$checkedval]);
							echo '<span class="radiolabel">'. $jtype .'</span>';
						?>
           </label>
					</div>
	
          	 
      <?php } ?>
      
              </div>


             <div class="col-sm-2">
               <?= $this->Form->submit('Update Results', ['class'=>'btn btn-primary btn-login float-right']); ?>
               <?= $this->Form->end(); ?>
              </div>
            
            </div>
      </div>
    </div>
</div>