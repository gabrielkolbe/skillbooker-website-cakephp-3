<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * TutorialComment Entity
 *
 * @property int $id
 * @property int $is_parent
 * @property int $is_child
 * @property int $parent_id
 * @property int $user_id
 * @property string $comment
 * @property int $approved
 * @property int $tutorial_id
 * @property string $username
 * @property string $userslug
 * @property string $useravatar
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Manager\Model\Entity\ParentTutorialComment $parent_tutorial_comment
 * @property \Manager\Model\Entity\User $user
 * @property \Manager\Model\Entity\Tutorial $tutorial
 * @property \Manager\Model\Entity\ChildTutorialComment[] $child_tutorial_comments
 */
class TutorialComment extends Entity
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
