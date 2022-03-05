<div class="row">
	<div class="col-md-12">
    <legend><?= h($tutorialSkill->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Tutorial') ?></th>
            <td><?= $tutorialSkill->has('tutorial') ? $this->Html->link($tutorialSkill->tutorial->name, ['controller' => 'Tutorials', 'action' => 'view', $tutorialSkill->tutorial->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill') ?></th>
            <td><?= $tutorialSkill->has('skill') ? $this->Html->link($tutorialSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $tutorialSkill->skill->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill Name') ?></th>
            <td><?= h($tutorialSkill->skill_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($tutorialSkill->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tutorialSkill->id) ?></td>
        </tr>
    </table>
</div>
</div>