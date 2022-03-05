<div class="row">
	<div class="col-md-12">
    <legend><?= h($jobsource->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($jobsource->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($jobsource->id) ?></td>
        </tr>
    </table>
</div>
</div>