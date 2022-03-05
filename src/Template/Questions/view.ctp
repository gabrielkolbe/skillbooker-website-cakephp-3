<?php $this->Html->script('/js/ckeditorcode/ckeditor', ['block' => true]); ?>
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

  <div class="col-xs-12 col-md-4">
    <div class="contentbox padding15">
    <h2>Question me!</h2> 
    <?php $useranswered = 0; ?>
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
  <div class="row">
    <div class="col-xs-12 col-md-12 contentbox padding15"> 

    <h1 class="toph1"><?php echo $question->name; ?></h1>
    <div class="infobox">
    Asked by <?php echo $this->Html->link($question->username,['plugin'=>null, 'controller'=>'online', 'action'=>'cv', $question->userslug]); ?> <!--(rating: <?php //echo $answer->userreputation; ?>) -->
    Viewed:  <strong><?php echo $question->hitcount; ?></strong> times</div><BR>    
    <?= $question->content ?>
    <BR><BR>
    
    <div class="skills">
    <?php 
    if(!empty($skills)){ 
    foreach($skills as $skill){
      echo $this->Html->link($skill->skill_name,['plugin'=>null, 'controller'=>'Questions', 'action'=>'search', $skill->slug], ['class'=>'btn btn-inverse']); 
    }
    }
    ?>
    </div>
    
  <?php if (!empty($this->request->session()->read('Auth.User.id'))) {  ?>
        <span onClick="sendajax('/questions/add_comment_modal/<?php echo $question->id; ?>')" class="fakelink float-left">Add Comment</span>   
<?php if ($this->request->session()->read('Auth.User.id') == $question->user_id ) {  ?>

    <div>
    <?php 
    if($question->answers < 1) { 
      echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $question->name), 'class' => 'fakelink float-right']);
    } else { ?>
    <span onClick="sendajax('/questions/delete_question_modal/<?php echo $question->slug; ?>')" class="fakelink float-right">Delete</span>
    <?php } ?>
    
    <span onClick="sendajax('/questions/edit_question_modal/<?php echo $question->slug; ?>')" class="fakelink float-right">Edit</span>
    </div>
<?php } 
//not logged in
} else { ?>
    <span onClick="sendajax('/users/loginmodal/')" class="fakelink float-left">Add Comment</span>
    <span onClick="sendajax('/users/loginmodal/')" class="fakelink float-right">Login to Edit</span>
<?php } ?>
<BR>
  </div>

<?php foreach ($questioncomments as $comment){ ?>
<div class="commentbox">
<?= $comment->comment ?>
<?php // $this->Text->autoParagraph(h($comment->comment)); ?> 
<span class="floatright">Comment by- <?php echo $this->Html->link($comment->username,['plugin'=>null, 'controller'=>'online', 'action'=>'cv', $comment->userslug]); ?>

<?php if (!empty($this->request->session()->read('Auth.User.id'))) { ?>
<?php if ($this->request->session()->read('Auth.User.id') == $comment->user_id ) { ?>
  <span onClick="sendajax('/questions/delete_comment_modal/<?php echo $comment->id; ?>')" class="fakelink float-right">Delete</span>
  <span onClick="sendajax('/questions/edit_comment_modal/<?php echo $comment->id; ?>')" class="fakelink float-right">Edit</span>
<?php }} ?>

</span>
</div>
<?php } ?>



<div class="col-xs-12 col-md-12">
<BR>
  <h2>
<?php if($question->answers > 0) { echo $question->answers; ?>
 Answer <?php } elseif($question->answers > 1) { echo $question->answers; ?> Answers </h2>
<BR>
<?php } ?>
</div>


<?php foreach($answers as $answer) { ?>
<div class="col-xs-12 col-md-12 contentbox padding15">
  <div class="infobox">
  Answered by <?php echo $this->Html->link($answer->username,['plugin'=>null, 'controller'=>'online', 'action'=>'cv', $answer->userslug]); ?> <!--(rating: <?php //echo $answer->userreputation; ?>) --></div><BR>
  <div><?= $answer->content ?></div>
<?php if (!empty($this->request->session()->read('Auth.User.id'))) {  ?>
    <span onClick="sendajax('/questions/add_comment_modal/<?php echo $answer->id; ?>')" class="fakelink float-left">Add Comment</span>
<?php if ($this->request->session()->read('Auth.User.id') == $answer->user_id ) {  ?>
  <div>
  <span onClick="sendajax('/questions/delete_answer_modal/<?php echo $answer->id; ?>')" class="fakelink float-right">Delete</span>
  <span onClick="sendajax('/questions/edit_answer_modal/<?php echo $answer->id; ?>')" class="fakelink float-right">Edit</span>
  </div>
<?php 
$useranswered = 1;
} ?>
<?php } else { ?>
    <span onClick="sendajax('/users/loginmodal/')" class="fakelink float-left">Add Comment</span>
<?php } ?>
<BR>
</div>
<?php foreach ($answercomments as $comment){ 
if($comment->question_id == $answer->id) { ?>
<div class="commentbox">
<?= $comment->comment ?> 
<span class="floatright">Comment by- <?php echo $this->Html->link($comment->username,['plugin'=>null, 'controller'=>'online', 'action'=>'cv', $comment->userslug]); ?>

<?php if (!empty($this->request->session()->read('Auth.User.id'))) { ?>
<?php if ($this->request->session()->read('Auth.User.id') == $comment->user_id ) { ?>
  <span onClick="sendajax('/questions/delete_comment_modal/<?php echo $comment->id; ?>')" class="fakelink float-right">Delete</span>
  <span onClick="sendajax('/questions/edit_comment_modal/<?php echo $comment->id; ?>')" class="fakelink float-right">Edit</span>
<?php }} ?>

</span>
</div>
<?php } }
 } ?>


<?php if (!empty($this->request->session()->read('Auth.User.id'))) {  ?>
<?php if ($this->request->session()->read('Auth.User.id') == $question->user_id ) { } else { ?>
<?php if ($useranswered == 1) { } else { ?>
<div class="col-xs-12 col-md-12 contentbox padding15"> 
<h2>Your Answer</h2>
<?php echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'questions','action' => 'answerquestion']]); ?>
<?php echo $this->Form->textarea('content', ['class'=>'form-control  validate[blockscript] ckeditor', 'label' => false]); ?>
<?= $this->Form->hidden('slug', ['value'=>$question->slug]); ?>
<?= $this->Form->button(__('Submit answer'), ['class'=>'btn btn-primary btn-xs float-right submit']) ?>
<?= $this->Form->end() ?>
<BR><BR>
</div>
<?php } } } else { ?>
    <span onClick="sendajax('/users/loginmodal/')" class="btn btn-primary btn-xs float-right">Please login submit your answer</span>
<?php } ?>

    
    </div>
  </div>
</div>