<div class="row">
<div class="col-sm-12">
 <ul class="horisontal_list">
  <?php foreach($categories as $category){?>
      <li><a href="/tutorials/category/<?php echo $category->slug; ?>" ><?php echo $category->name; ?></a></li>
      <?php } ?>
  </ul>
 
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="suggestionbox">
 <h1>Search Results</h2>
 <HR>   
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
            
</div>  
</div>

</div>