<div class="row">
	<div class="col-md-12">
    <legend><?= h($userStatus->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($userStatus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userStatus->id) ?></td>
        </tr>
    </table>
</div>
</div>