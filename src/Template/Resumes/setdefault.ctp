
<?php 
$class="one";
$color1="one"; 
$color2="two";
?>
<?php echo $this->Form->create(null,  ['url' => ['plugin' => null, 'controller' => 'resumes', 'action' => 'setdefaultaction'], 'type' => 'file', 'id' => 'addresume']); ?>
<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary float-right hideme', 'id' => 'btn']) ?>   
<h2>Set default Resume/CV</h2>
<?php if(!empty($resumes)){ ?>
					<?php foreach($resumes as $resume){ ?>
          <?php $class=($class==$color1)?$color2:$color1;  ?> 
        <div class="row <?php echo $class; ?>">
            <div class="col-sm-12">
              <?php if($resume->is_default == 1) { $check = 'checked'; } else { $check = ''; } ?>
              <input type="radio" name="setdefault" value="<?php echo $resume->id; ?>" <?php echo $check; ?> > 
              <strong><?php echo $resume->name; ?></strong>
              <span class="float-right"><?php echo $resume->created; ?></span>     
            </div>
        </div>	
					<?php } ?>
<?php } ?>

<?= $this->Form->end() ?>