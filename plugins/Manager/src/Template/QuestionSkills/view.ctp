<div class="row">
	<div class="col-md-12">
    <legend><?= h($questionSkill->id) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $questionSkill->has('question') ? $this->Html->link($questionSkill->question->name, ['controller' => 'Questions', 'action' => 'view', $questionSkill->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill') ?></th>
            <td><?= $questionSkill->has('skill') ? $this->Html->link($questionSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $questionSkill->skill->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill Name') ?></th>
            <td><?= h($questionSkill->skill_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($questionSkill->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Industry') ?></th>
            <td><?= $questionSkill->has('industry') ? $this->Html->link($questionSkill->industry->name, ['controller' => 'Industries', 'action' => 'view', $questionSkill->industry->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($questionSkill->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($questionSkill->created) ?></td>
        </tr>
    </table>
</div>
</div>