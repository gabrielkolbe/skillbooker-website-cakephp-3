<div class="row">
	<div class="col-md-12">
    <legend><?= h($tutorial->name) ?></legend>
    
  <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $tutorial->content; ?>
    </div>
    
    
    <table class="table">
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($tutorial->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tutorial Category') ?></th>
            <td><?= $tutorial->has('tutorial_category') ? $this->Html->link($tutorial->tutorial_category->name, ['controller' => 'TutorialCategories', 'action' => 'view', $tutorial->tutorial_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short') ?></th>
            <td><?= h($tutorial->short) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Source') ?></th>
            <td><?= h($tutorial->source) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($tutorial->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Twittercount') ?></th>
            <td><?= $this->Number->format($tutorial->twittercount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hitcount') ?></th>
            <td><?= $this->Number->format($tutorial->hitcount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($tutorial->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($tutorial->modified) ?></td>
        </tr>
    </table>

    <div class="related">
        <h4><?= __('Related Tutorial Comments') ?></h4>
        <?php if (!empty($tutorial->tutorial_comments)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Is Parent') ?></th>
                <th scope="col"><?= __('Is Child') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Approved') ?></th>
                <th scope="col"><?= __('Tutorial Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Userslug') ?></th>
                <th scope="col"><?= __('Useravatar') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tutorial->tutorial_comments as $tutorialComments): ?>
            <tr>
                <td><?= h($tutorialComments->id) ?></td>
                <td><?= h($tutorialComments->is_parent) ?></td>
                <td><?= h($tutorialComments->is_child) ?></td>
                <td><?= h($tutorialComments->parent_id) ?></td>
                <td><?= h($tutorialComments->user_id) ?></td>
                <td><?= h($tutorialComments->comment) ?></td>
                <td><?= h($tutorialComments->approved) ?></td>
                <td><?= h($tutorialComments->tutorial_id) ?></td>
                <td><?= h($tutorialComments->username) ?></td>
                <td><?= h($tutorialComments->userslug) ?></td>
                <td><?= h($tutorialComments->useravatar) ?></td>
                <td><?= h($tutorialComments->created) ?></td>
                <td><?= h($tutorialComments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TutorialComments', 'action' => 'view', $tutorialComments->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TutorialComments', 'action' => 'edit', $tutorialComments->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TutorialComments', 'action' => 'delete', $tutorialComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorialComments->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tutorial Images') ?></h4>
        <?php if (!empty($tutorial->tutorial_images)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Tutorial Id') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Photo') ?></th>
                <th scope="col"><?= __('Alttag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tutorial->tutorial_images as $tutorialImages): ?>
            <tr>
                <td><?= h($tutorialImages->id) ?></td>
                <td><?= h($tutorialImages->tutorial_id) ?></td>
                <td><?= h($tutorialImages->location) ?></td>
                <td><?= h($tutorialImages->photo) ?></td>
                <td><?= h($tutorialImages->alttag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TutorialImages', 'action' => 'view', $tutorialImages->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TutorialImages', 'action' => 'edit', $tutorialImages->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TutorialImages', 'action' => 'delete', $tutorialImages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorialImages->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tutorial Skills') ?></h4>
        <?php if (!empty($tutorial->tutorial_skills)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Tutorial Id') ?></th>
                <th scope="col"><?= __('Skill Id') ?></th>
                <th scope="col"><?= __('Skill Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tutorial->tutorial_skills as $tutorialSkills): ?>
            <tr>
                <td><?= h($tutorialSkills->id) ?></td>
                <td><?= h($tutorialSkills->tutorial_id) ?></td>
                <td><?= h($tutorialSkills->skill_id) ?></td>
                <td><?= h($tutorialSkills->skill_name) ?></td>
                <td><?= h($tutorialSkills->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TutorialSkills', 'action' => 'view', $tutorialSkills->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TutorialSkills', 'action' => 'edit', $tutorialSkills->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TutorialSkills', 'action' => 'delete', $tutorialSkills->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorialSkills->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>