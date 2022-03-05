<div class="row">
	<div class="col-md-12">
    <legend><?= h($salesoption->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($salesoption->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($salesoption->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Level') ?></th>
            <td><?= h($salesoption->level) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Savevalue') ?></th>
            <td><?= h($salesoption->savevalue) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesoption->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($salesoption->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realvalue') ?></th>
            <td><?= $this->Number->format($salesoption->realvalue) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($salesoption->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($salesoption->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($salesoption->description)); ?>
    </div>
</div>
</div>