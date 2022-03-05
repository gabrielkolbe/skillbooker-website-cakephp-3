<div class="row">
	<div class="col-md-12">
    <legend><?= h($question->name) ?></legend>
    <table class="table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $question->has('user') ? $this->Html->link($question->user->name, ['controller' => 'Users', 'action' => 'view', $question->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Question') ?></th>
            <td><?= $question->has('parent_question') ? $this->Html->link($question->parent_question->name, ['controller' => 'Questions', 'action' => 'view', $question->parent_question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($question->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($question->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($question->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Userslug') ?></th>
            <td><?= h($question->userslug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Industry') ?></th>
            <td><?= $question->has('industry') ? $this->Html->link($question->industry->name, ['controller' => 'Industries', 'action' => 'view', $question->industry->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skills') ?></th>
            <td><?= h($question->skills) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($question->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Userreputation') ?></th>
            <td><?= $this->Number->format($question->userreputation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($question->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Twittercount') ?></th>
            <td><?= $this->Number->format($question->twittercount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hitcount') ?></th>
            <td><?= $this->Number->format($question->hitcount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Votes') ?></th>
            <td><?= $this->Number->format($question->votes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Answers') ?></th>
            <td><?= $this->Number->format($question->answers) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($question->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($question->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($question->content)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Question Comments') ?></h4>
        <?php if (!empty($question->question_comments)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Userslug') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($question->question_comments as $questionComments): ?>
            <tr>
                <td><?= h($questionComments->id) ?></td>
                <td><?= h($questionComments->user_id) ?></td>
                <td><?= h($questionComments->question_id) ?></td>
                <td><?= h($questionComments->parent_id) ?></td>
                <td><?= h($questionComments->comment) ?></td>
                <td><?= h($questionComments->username) ?></td>
                <td><?= h($questionComments->userslug) ?></td>
                <td><?= h($questionComments->created) ?></td>
                <td><?= h($questionComments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'QuestionComments', 'action' => 'view', $questionComments->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'QuestionComments', 'action' => 'edit', $questionComments->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'QuestionComments', 'action' => 'delete', $questionComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionComments->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Question Skills') ?></h4>
        <?php if (!empty($question->question_skills)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('Skill Id') ?></th>
                <th scope="col"><?= __('Skill Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Industry Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($question->question_skills as $questionSkills): ?>
            <tr>
                <td><?= h($questionSkills->id) ?></td>
                <td><?= h($questionSkills->question_id) ?></td>
                <td><?= h($questionSkills->skill_id) ?></td>
                <td><?= h($questionSkills->skill_name) ?></td>
                <td><?= h($questionSkills->slug) ?></td>
                <td><?= h($questionSkills->industry_id) ?></td>
                <td><?= h($questionSkills->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'QuestionSkills', 'action' => 'view', $questionSkills->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'QuestionSkills', 'action' => 'edit', $questionSkills->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'QuestionSkills', 'action' => 'delete', $questionSkills->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionSkills->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Questions') ?></h4>
        <?php if (!empty($question->child_questions)): ?>
        <table class="table">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Userslug') ?></th>
                <th scope="col"><?= __('Userreputation') ?></th>
                <th scope="col"><?= __('Industry Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Twittercount') ?></th>
                <th scope="col"><?= __('Hitcount') ?></th>
                <th scope="col"><?= __('Skills') ?></th>
                <th scope="col"><?= __('Votes') ?></th>
                <th scope="col"><?= __('Answers') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($question->child_questions as $childQuestions): ?>
            <tr>
                <td><?= h($childQuestions->id) ?></td>
                <td><?= h($childQuestions->user_id) ?></td>
                <td><?= h($childQuestions->parent_id) ?></td>
                <td><?= h($childQuestions->name) ?></td>
                <td><?= h($childQuestions->slug) ?></td>
                <td><?= h($childQuestions->username) ?></td>
                <td><?= h($childQuestions->userslug) ?></td>
                <td><?= h($childQuestions->userreputation) ?></td>
                <td><?= h($childQuestions->industry_id) ?></td>
                <td><?= h($childQuestions->status) ?></td>
                <td><?= h($childQuestions->content) ?></td>
                <td><?= h($childQuestions->twittercount) ?></td>
                <td><?= h($childQuestions->hitcount) ?></td>
                <td><?= h($childQuestions->skills) ?></td>
                <td><?= h($childQuestions->votes) ?></td>
                <td><?= h($childQuestions->answers) ?></td>
                <td><?= h($childQuestions->created) ?></td>
                <td><?= h($childQuestions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Questions', 'action' => 'view', $childQuestions->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Questions', 'action' => 'edit', $childQuestions->id], ['class' => 'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Questions', 'action' => 'delete', $childQuestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childQuestions->id), 'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>