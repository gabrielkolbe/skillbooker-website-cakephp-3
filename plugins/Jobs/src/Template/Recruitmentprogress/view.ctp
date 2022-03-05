<div class="row">
	<div class="col-md-12">
    <legend><?= h($recruitmentprogres->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($recruitmentprogres->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($recruitmentprogres->id) ?></td>
        </tr>
    </table>
</div>
</div>