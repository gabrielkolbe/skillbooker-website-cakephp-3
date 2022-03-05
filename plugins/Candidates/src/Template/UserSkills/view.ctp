<div class="row">
	<div class="col-md-12">
    <legend><?= h($userSkill->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userSkill->has('user') ? $this->Html->link($userSkill->user->name, ['controller' => 'Users', 'action' => 'view', $userSkill->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill') ?></th>
            <td><?= $userSkill->has('skill') ? $this->Html->link($userSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $userSkill->skill->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill Name') ?></th>
            <td><?= h($userSkill->skill_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($userSkill->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userSkill->id) ?></td>
        </tr>
    </table>
</div>
</div>