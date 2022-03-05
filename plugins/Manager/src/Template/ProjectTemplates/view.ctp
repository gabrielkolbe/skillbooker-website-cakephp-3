<div class="row">
	<div class="col-md-12">
    <legend><?= h($projectTemplate->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($projectTemplate->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($projectTemplate->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description') ?></th>
            <td><?= h($projectTemplate->short_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($projectTemplate->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($projectTemplate->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($projectTemplate->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Stage1') ?></h4>
        <?= $this->Text->autoParagraph(h($projectTemplate->stage1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Stage2') ?></h4>
        <?= $this->Text->autoParagraph(h($projectTemplate->stage2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Stage3') ?></h4>
        <?= $this->Text->autoParagraph(h($projectTemplate->stage3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Stage4') ?></h4>
        <?= $this->Text->autoParagraph(h($projectTemplate->stage4)); ?>
    </div>
</div>
</div>