<div class="col-sm-12">
  <div class="contentbox"> 
  <h1 class="section-heading"><?= h($event->title) ?></h1>
   <h3 class="section-heading">Venue: <?= h($event->venue['title']) ?></h3>
  <small>Event date on  <?php $eventdate = $event->eventdate;
        echo $eventdate->i18nFormat('dd-MM-yyyy'); ?></small><BR><BR>
        
        <strong>Available spaces:</strong> <?= $event->places ?>
        <BR><strong>Current Amount of Attendees:</strong> <?= $event->attendants ?>

<BR><BR>
  
  <h3 class="section-heading">Event Trainer(s)</h3>  
   <?php 
   $trainers = $event->trainers;
   foreach($trainers as $trainer){
      echo $trainer['name'].'<BR>';
   }
   ?>
   
   
<BR><BR>

    <?php if($event->displayimagecontent == 1) {  
          if(!empty($event->mainimage)) { 
              echo $this->Html->image('postcard_'.$event->mainimage, ['class'=> 'contentboximage']); }  } ?>
   <?= $event->description ?>
   <BR><BR>
   
  </div>
</div>