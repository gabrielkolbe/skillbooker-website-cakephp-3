<div class="row">
	<div class="col-md-12">
    <legend><?= h($urlview->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($urlview->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Urlcontroller') ?></th>
            <td><?= $urlview->has('urlcontroller') ? $this->Html->link($urlview->urlcontroller->name, ['controller' => 'Urlcontrollers', 'action' => 'view', $urlview->urlcontroller->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($urlview->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($urlview->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($urlview->modified) ?></td>
        </tr>
    </table>
</div>
</div>