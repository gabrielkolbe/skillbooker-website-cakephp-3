<div class="row">
	<div class="col-md-12">
  
<?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id), 'class' => 'btn btn-danger float-right marginleft10'] );  ?> 
<?php echo $this->Html->link('Edit Country', ['controller' => 'countries', 'action' => 'edit', $country->id], ['class' => 'btn btn-warning float-right'] );  ?>


    <h3><?= h($country->name) ?></h3>
      <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($country->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iso Alpha2') ?></th>
            <td><?= h($country->iso_alpha2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iso Alpha3') ?></th>
            <td><?= h($country->iso_alpha3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country Currency') ?></th>
            <td><?= h($country->country_currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Name') ?></th>
            <td><?= h($country->currency_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Symbol') ?></th>
            <td><?= h($country->currency_symbol) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Html Entity') ?></th>
            <td><?= h($country->html_entity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= h($country->flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iso Numeric') ?></th>
            <td><?= $this->Number->format($country->iso_numeric) ?></td>
        </tr>
        <tr>

        </tr>
    </table>
</div>
