<div class="row">
	<div class="col-md-12">
    <legend><?= h($datedesc->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($datedesc->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($datedesc->id) ?></td>
        </tr>
    </table>
</div>
</div>