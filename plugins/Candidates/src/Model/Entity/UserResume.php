<?php
namespace Candidates\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserResume Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $downloads
 * @property string $resume
 * @property int $is_searchable
 * @property string $resume_content
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Candidates\Model\Entity\User $user
 */
class UserResume extends Entity
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
