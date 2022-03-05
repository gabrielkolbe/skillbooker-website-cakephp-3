<div class="row">
<div class="col-sm-12">
 <ul class="horisontal_list">
 
     
  <?php foreach($categories as $category){?>
      <li class="<?php
      if($category->slug == $currentcategory->slug){
       echo 'current';
      } ?>
      "><a href="/tutorials/category/<?php echo $category->slug; ?>" ><?php echo $category->name; ?></a></li>
  <?php } ?>
  </ul>

   <div style="float:left;">This tutorial has been viewed:  <strong><?php echo $tutorial['hitcount']; ?></strong> times</div> 
</div>
</div>

<div class="row">
<div class="col-sm-2">
<div class="suggestionbox">
<style>
.searchinput {
    width: 110px !important;
    margin-top:15px;
    margin-left:2px;
}
.searchbutton {
    border: 0px;
    float: right;
    margin-top: -20px;
    margin-right:10px;
}
</style>

  <?php
      echo $this->Form->create(null, ['url' => ['plugin' => null,'controller' => 'tutorials','action' => 'list']]);
      echo $this->Form->hidden('dosearch', ['value' => 'do']);
      echo $this->Form->input('search', ['class' => 'searchinput', 'label' => '', 'placeholder' => 'Search']);
      echo $this->Form->button('', ['class'=>'fa fa-search searchbutton']);
      echo $this->Form->end(); 
  ?>
      
  <h2 style="padding-left: 10px; padding-top: 10px;"><?php echo $currentcategory->name; ?></h2>
    
   <ul class="thelist">
      <?php
      $count=0;
      foreach($tutorials as $list) {
        echo '<li class="' . (++$count%2 ? "odd" : "even") . '">'; 
        ?>
        <a href="/tutorials/<?php echo $list->slug; ?>"><?php echo $list->name; ?></a>
        <br><?PHP echo $list['created']; ?>
        </li>
      <?php } ?>                
    </ul> 
            
<HR>
<div class="skills">
<?php
if(!empty($skills)){ 
  foreach($skills as $skill){
    echo $this->Html->link($skill->skill_name,['plugin'=>null, 'controller'=>'Tutorials', 'action'=>'search', $skill->slug], ['class'=>'btn btn-inverse']); 
  }
}
?>
</div>


</div>  
</div>


<div class="col-sm-8">
<div class="contentbox padding15">
    <h1><?php echo $tutorial['name']; ?></h1>
    
<?php if(!empty($tutorial['youtube']))  { ?>
<BR>
  <div  class="youtubevid"><h2>Youtube video</h2>
    <iframe width="420" height="315" src="https://www.youtube.com/embed/<?php echo $tutorial['youtube']; ?>">
    </iframe>
  </div>
<?php } ?>

    <?php echo $tutorial['content']; ?>
    <BR>
    <?php echo $tutorial['source']; ?><BR>
    <strong>Posted on:</strong> <?php echo $tutorial['created']; ?> <BR>
    <?php if (!empty($this->request->session()->read('Auth.User.id'))) { 
     if(!empty($tutorial['download']))  { ?>
     <a href="/download/<?php echo $tutorial['download'] ?>"> Download the code <i class="fa fa-download btn btn-primary" aria-hidden="true"></i></a>
     <?php } else { 
        echo $this->Html->link('Contact us for this code',['plugin'=>null, 'controller'=>'Users', 'action'=>'contact'], ['class'=>' btn btn-primary']);
      } ?>
    <span onClick="sendajax('/comments/comment/<?=$tutorial['id']?>')" class="btn btn-primary float-right">Please leave a comment</span>
    <?php } else {
     echo $this->Html->link('Login to download the code',['plugin'=>null, 'controller'=>'Users', 'action'=>'login'], ['class'=>' btn btn-primary']);
     ?>
    <span onClick="sendajax('/users/registermodal/')" class="btn btn-primary float-right">Please login/register to leave comments</span>
    <?php } ?>
<div class="skills">
<?php 
if(!empty($skills)){ 
  foreach($skills as $skill){
    echo $this->Html->link($skill->skill_name,['plugin'=>null, 'controller'=>'Tutorials', 'action'=>'search', $skill->slug], ['class'=>'btn btn-inverse']); 
  }
}
?>
</div>
    
</div>  <!-- close contentbox -->

  <?php 
  
  if(!empty($comments)){
  
  $commentidlist = array();
  $childlist = array(); 
  
  foreach ($comments as $comment){  
  
  if($comment->is_parent == 1){    
    
  $do = 'show';  
  if(in_array($comment->id, $commentidlist)){ $do = 'skip'; } else { 
  array_push($commentidlist, $comment->id);
  $do = 'show'; }  

  if($do == 'show') {     ?>
    
  <div class="commentbox">
  
     <div class="float-left">
     
          <?php if(!empty($comment->useravatar)) { 
          echo $this->Html->image('/img/uploads/avatars/'.$comment->useravatar, [
                    'alt' => $comment->username,
                    'class' => 'img-thumbnail xs-tumbnail',
                    'url' => ['controller' => 'users', 'action' => 'onlinecv', $comment->userslug]
                ]);     
          } else {
                   
          echo $this->Html->image('member.jpg', [
              'alt' => $comment->username,
              'class' => 'img-thumbnail xs-tumbnail',
              'url' => ['controller' => 'users', 'action' => 'onlinecv', $comment->userslug]
          ]);
          
          }
          ?>
              
    </div>
  
  <?php echo $this->Html->link($comment->username, ['controller'=>'users','action'=>'onlinecv',$comment->userslug]); ?><BR>
   <?php echo $comment->comment; ?>


    <div class="float-right">
      <?php if (!empty($this->request->session()->read('Auth.User.id'))) {  if( $comment->user_id == $this->request->session()->read('Auth.User.id') ) { ?> <span onClick="sendajax('/comments/delete/<?=$comment->id?>-<?=$tutorial['id']?>')" class="btn btn-danger btn-xxs">delete</span> <?php } } ?>
      <span onClick="sendajax('/comments/reply/<?=$comment->id?>-<?=$tutorial['id']?>')" class="btn btn-primary btn-xxs">Reply</span>    
    </div>    
  </div>

<?php
  } //if parent id
 } // close do/show
  
   if(!empty($comment->child['id']) ){
   if($comment->child['is_child'] == 1 ){
  
   
  $childdo = 'show';
 
  if(in_array($comment->child['id'], $childlist)){ $childdo = 'skip'; } else { 
  array_push($childlist, $comment->child['id']);
  $childdo = 'show'; }  
  
  if($childdo == 'show') { 
  ?>
   
  <div class="commentbox childbox">
  
    <div class="float-left">
      <?php if(!empty($comment->child['useravatar'])) {  
      echo $this->Html->image('/img/uploads/avatars/'.$comment->child['useravatar'], [
                'alt' => $comment->child['username'],
                'class' => 'img-thumbnail xs-tumbnail',
                'url' => ['controller' => 'users', 'action' => 'onlinecv', $comment->child['userslug']]
            ]);
      } else {
               
      echo $this->Html->image('member.jpg', [
          'alt' => $comment->child['username'],
          'class' => 'img-thumbnail xs-tumbnail',
          'url' => ['controller' => 'users', 'action' => 'onlinecv', $comment->child['userslug']]
      ]);
      
      }
      ?>
    </div>
  <?php echo $this->Html->link($comment->child['username'], ['controller'=>'users','action'=>'onlinecv',$comment->child['userslug']]); ?><BR>
   <?php echo $comment->child['comment']; ?>
     <div class="float-right">
        <?php if (!empty($this->request->session()->read('Auth.User.id'))) {  if( $comment->child['user_id'] == $this->request->session()->read('Auth.User.id') ) { ?> <span onClick="sendajax('/comments/delete/<?=$comment->id?>-<?=$tutorial['id']?>')" class="btn btn-danger btn-xxs">delete</span> <?php } } ?>
    </div>     
  </div>
    
<?php 
    } // if childdo    
   } // if child is 1
   } // if not empty
?>

   
<?php
}   // close foreach comments
}   //close if comments
?>

</div>

<div class="col-sm-2">
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