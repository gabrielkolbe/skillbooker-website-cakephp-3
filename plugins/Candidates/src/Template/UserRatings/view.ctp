<div class="row">
	<div class="col-md-12">
    <legend><?= h($userRating->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($userRating->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userRating->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stars') ?></th>
            <td><?= $this->Number->format($userRating->stars) ?></td>
        </tr>
    </table>
</div>
</div>