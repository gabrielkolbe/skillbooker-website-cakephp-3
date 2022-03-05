<div class="row">
	<div class="col-md-12">
    <legend><?= h($softwareCategory->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($softwareCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($softwareCategory->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($softwareCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($softwareCategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($softwareCategory->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Software Features') ?></h4>
        <?php if (!empty($softwareCategory->software_features)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Software Category Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($softwareCategory->software_features as $softwareFeatures): ?>
            <tr>
                <td><?= h($softwareFeatures->id) ?></td>
                <td><?= h($softwareFeatures->name) ?></td>
                <td><?= h($softwareFeatures->software_category_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SoftwareFeatures', 'action' => 'view', $softwareFeatures->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SoftwareFeatures', 'action' => 'edit', $softwareFeatures->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SoftwareFeatures', 'action' => 'delete', $softwareFeatures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $softwareFeatures->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Softwares') ?></h4>
        <?php if (!empty($softwareCategory->softwares)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Pricedisplay') ?></th>
                <th scope="col"><?= __('Currency Id') ?></th>
                <th scope="col"><?= __('Theimage') ?></th>
                <th scope="col"><?= __('Software Pricetype Id') ?></th>
                <th scope="col"><?= __('Software Category Id') ?></th>
                <th scope="col"><?= __('Software Support') ?></th>
                <th scope="col"><?= __('Software Demooption') ?></th>
                <th scope="col"><?= __('Software Deployment') ?></th>
                <th scope="col"><?= __('Software Features') ?></th>
                <th scope="col"><?= __('Software Training') ?></th>
                <th scope="col"><?= __('Trail Url') ?></th>
                <th scope="col"><?= __('Freeversion Url') ?></th>
                <th scope="col"><?= __('Demo Url') ?></th>
                <th scope="col"><?= __('Pricing Url') ?></th>
                <th scope="col"><?= __('Signup Url') ?></th>
                <th scope="col"><?= __('Customer Url') ?></th>
                <th scope="col"><?= __('Priceperuser') ?></th>
                <th scope="col"><?= __('Freeversion') ?></th>
                <th scope="col"><?= __('Freetrail') ?></th>
                <th scope="col"><?= __('Demoavailable') ?></th>
                <th scope="col"><?= __('Rating') ?></th>
                <th scope="col"><?= __('Short Description') ?></th>
                <th scope="col"><?= __('Short Description2') ?></th>
                <th scope="col"><?= __('Short Description3') ?></th>
                <th scope="col"><?= __('Short Description4') ?></th>
                <th scope="col"><?= __('Short Description5') ?></th>
                <th scope="col"><?= __('Short Description6') ?></th>
                <th scope="col"><?= __('Long Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($softwareCategory->softwares as $softwares): ?>
            <tr>
                <td><?= h($softwares->id) ?></td>
                <td><?= h($softwares->user_id) ?></td>
                <td><?= h($softwares->name) ?></td>
                <td><?= h($softwares->slug) ?></td>
                <td><?= h($softwares->status) ?></td>
                <td><?= h($softwares->price) ?></td>
                <td><?= h($softwares->pricedisplay) ?></td>
                <td><?= h($softwares->currency_id) ?></td>
                <td><?= h($softwares->theimage) ?></td>
                <td><?= h($softwares->software_pricetype_id) ?></td>
                <td><?= h($softwares->software_category_id) ?></td>
                <td><?= h($softwares->software_support) ?></td>
                <td><?= h($softwares->software_demooption) ?></td>
                <td><?= h($softwares->software_deployment) ?></td>
                <td><?= h($softwares->software_features) ?></td>
                <td><?= h($softwares->software_training) ?></td>
                <td><?= h($softwares->trail_url) ?></td>
                <td><?= h($softwares->freeversion_url) ?></td>
                <td><?= h($softwares->demo_url) ?></td>
                <td><?= h($softwares->pricing_url) ?></td>
                <td><?= h($softwares->signup_url) ?></td>
                <td><?= h($softwares->customer_url) ?></td>
                <td><?= h($softwares->priceperuser) ?></td>
                <td><?= h($softwares->freeversion) ?></td>
                <td><?= h($softwares->freetrail) ?></td>
                <td><?= h($softwares->demoavailable) ?></td>
                <td><?= h($softwares->rating) ?></td>
                <td><?= h($softwares->short_description) ?></td>
                <td><?= h($softwares->short_description2) ?></td>
                <td><?= h($softwares->short_description3) ?></td>
                <td><?= h($softwares->short_description4) ?></td>
                <td><?= h($softwares->short_description5) ?></td>
                <td><?= h($softwares->short_description6) ?></td>
                <td><?= h($softwares->long_description) ?></td>
                <td><?= h($softwares->created) ?></td>
                <td><?= h($softwares->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Softwares', 'action' => 'view', $softwares->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Softwares', 'action' => 'edit', $softwares->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Softwares', 'action' => 'delete', $softwares->id], ['confirm' => __('Are you sure you want to delete # {0}?', $softwares->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>