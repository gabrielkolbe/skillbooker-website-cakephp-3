
<section id="event-search" class="bg-img-9"> 
	               <div class="event-container"> 
                
                <div class="container" style="margin-bottom:20px;">
				<div class="row"> 
  <h1 class="section-heading"><?= h($event->title) ?></h1>

  <small>Event date on  <?php $eventdate = $event->eventdate;
        echo $eventdate->i18nFormat('dd-MM-yyyy'); ?></small><BR>

  <BR>
    <?php if($event->displayimagecontent == 1) {  
          if(!empty($event->images['0']['name'])) { 
              echo $this->Html->image('postcard_'.$event->images['0']['name'], ['class'=> 'contentboximage']); }  } ?>
   <?= $event->description ?>
   <BR>  

  </div>
</div>
</div>
</section>