<div class="row">
	<div class="col-md-12">
    <legend><?= h($tutorialImage->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Tutorial') ?></th>
            <td><?= $tutorialImage->has('tutorial') ? $this->Html->link($tutorialImage->tutorial->name, ['controller' => 'Tutorials', 'action' => 'view', $tutorialImage->tutorial->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= h($tutorialImage->location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= h($tutorialImage->photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alttag') ?></th>
            <td><?= h($tutorialImage->alttag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tutorialImage->id) ?></td>
        </tr>
    </table>
</div>
</div>