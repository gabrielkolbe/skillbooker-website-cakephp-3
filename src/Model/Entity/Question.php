<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $user_id
 * @property string $username
 * @property string $userslug
 * @property int $userreputation
 * @property int $industry_id
 * @property int $status
 * @property string $content
 * @property int $twittercount
 * @property int $hitcount
 * @property string $skills
 * @property int $votes
 * @property int $answers
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Industry $industry
 * @property \App\Model\Entity\QuestionAnswer[] $question_answers
 * @property \App\Model\Entity\QuestionComment[] $question_comments
 * @property \App\Model\Entity\QuestionSkill[] $question_skills
 */
class Question extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
