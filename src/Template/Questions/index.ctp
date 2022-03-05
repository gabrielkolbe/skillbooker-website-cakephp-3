<?php $this->Html->css('selector', ['block' => true]); ?>
<?php $this->Html->script('selector', ['block' => 'scriptBottom']); ?>
<script>
    $(function () {

			var $activate_selectator4 = $('#activate_selectator4');
			$activate_selectator4.click(function () {
				var $select4 = $('.select4');
				if ($select4.data('selectator') === undefined) {
					$select4.selectator({
						showAllOptionsOnFocus: true
					});
					$activate_selectator4.val('destroy selector');
				} else {
					$select4.selectator('destroy');
					$activate_selectator4.val('activate selector');
				}
			});
			$activate_selectator4.trigger('click');

		});
    

	</script> 
<style>
#activate_selectator4 {
    display: none;
}

.multiple .selectator_input, .multiple .selectator_textlength {
    width: 100% !important;
}

.selectator { margin-top: 0px !important; }

#selectator_select4 {min-height:0px !important;}


</style>
  <input value="activate selector" id="activate_selectator4" type="button">
  
  <div class="row">
<div class="col-xs-12 col-md-12">
    <h1 class="toph1">Recent Questions</h1>
</div>

  <div class="col-xs-12 col-md-2">
    <div class="contentbox padding15">
    <h2>Question me!</h2> 
    
    <?php echo $this->Form->create('Questions',['url'=>['plugin'=>null,'controller'=>'questions','action'=>'index']]); ?>
    <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'freesearch']); ?>
    <?php echo $this->Form->input('searchword', ['class'=>'form-control floatright', 'label' => false, 'placeholder'=>'Search Questions']);  ?>
    <?= $this->Form->submit('Let it rip!', ['class'=>'btn btn-primary btn-xs float-right']); ?>
    <?= $this->Form->end(); ?>
   
 <div class="col-xs-12 col-md-12"><BR><BR>
 <h2>Search by skill</h2>
 </div>
       
   
  <?php echo $this->Form->create('Questions',['url'=>['plugin'=>null,'controller'=>'questions','action'=>'index']]); ?>
  <?php echo $this->Form->input('sendfrom', ['type' => 'hidden', 'value' => 'skillsearch']); ?>

  <input value="activate selector" id="activate_selectator4" type="button">
  
    <select name="skill[]" multiple="multiple" class="select4" size="7" style="display: none;">
    <?php
    foreach($questionskillsdistinct as $key => $name){
      if(!empty($selectedprojectskills)) {
        if (array_key_exists($key, $selectedquestionskills)) { echo '<option value="'.$key.'" selected>'.$name.'</option>'; } else { echo '<option value="'.$key.'">'.$name.'</option>'; }
      } else {
        echo '<option value="'.$key.'">'.$name.'</option>';
      } 
    }
    
    ?>
     </select>
  
    <?= $this->Form->submit('Searh by Skill', ['class'=>'btn btn-primary btn-xs float-right']); ?>
    <?= $this->Form->end(); ?>
      <BR><BR>
    <div class="sideimg bigger768">
    <img src="/img/lego_305.jpg">
  </div> 
    
    </div>
  </div>
	<div class="col-xs-12 col-md-8">
    <div class="contentbox padding15"> 

        <table class="table table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th scope="col" width="5%"><?= $this->Paginator->sort('answers') ?></th>
                <th scope="col" width="5%"><?= $this->Paginator->sort('hitcount', 'Views') ?></th>                                
                <th scope="col" width="85%"><?= $this->Paginator->sort('name') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= $question->answers ?></td>
                <td><?= $question->hitcount ?></td>
                <td>
                <H2><?= $this->Html->link($question->name, ['controller' => 'Questions', 'action' => 'view', $question->slug]); ?></h2>
                <small><?= $question->skills ?></small> <!-- <span class="float-right">asked by <?= $this->Html->link($question->username, ['controller' => 'Users', 'action' => 'view', $question->userslug]); ?> <?= $question->userreputation ?></span> -->
                </td>    
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    </div>
    
        <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
    
  </div>
  
      <div class="col-md-2">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- skillbooker vertical -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-3625264154493537"
         data-ad-slot="4826439165"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    </div>
    
    
</div>