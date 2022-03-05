<div class="row">
	<div class="col-md-12">
<H1><?php if(!empty($user->avatar)) { echo $this->Html->image($user->avatar, ['class'=> 'small_avatar']); }   ?> <?= $user->firstname ?> <?= $user->lastname ?></H1>   
<?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger float-right marginleft10'] );  ?> 
<?php echo $this->Html->link('Edit User', ['controller' => 'users', 'action' => 'edit', $user->id], ['class' => 'btn btn-warning float-right'] );  ?>


    <legend>User Details</legend>
    <table class="table">
        <tr>
            <th style=scope="row"><?= __('Role') ?></th>
            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Job Title') ?></th>
            <td><?= h($user->jobtitle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= h($user->company) ?></td>
        </tr> 
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->postcode) ?>, <?= h($user->town) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
       
</div>
</div>

<div class="row">   
    <div id="map"></div>
    <script>
    // Initialize and add the map
    function initMap() {
    // The location of Uluru
    <?php echo 'var uluru = {lat: '.$user->latitude.', lng: '.$user->longitude.'}'; ?>
    // The map, centered at Uluru
    var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 12, center: uluru});
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: uluru, map: map});
    }
    
    </script>  
</div> 