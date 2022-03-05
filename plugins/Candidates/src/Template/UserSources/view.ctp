<div class="row">
	<div class="col-md-12">
    <legend><?= h($userSource->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($userSource->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userSource->id) ?></td>
        </tr>
    </table>
</div>
</div>