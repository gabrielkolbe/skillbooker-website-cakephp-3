<div class="row">
	<div class="col-md-12">
    <legend><?= h($softwareFeature->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($softwareFeature->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Software Category') ?></th>
            <td><?= $softwareFeature->has('software_category') ? $this->Html->link($softwareFeature->software_category->name, ['controller' => 'SoftwareCategories', 'action' => 'view', $softwareFeature->software_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($softwareFeature->id) ?></td>
        </tr>
    </table>
</div>
</div>