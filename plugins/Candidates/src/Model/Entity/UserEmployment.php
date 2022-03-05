<?php
namespace Candidates\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserEmployment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $position
 * @property string $company
 * @property string $job_location
 * @property \Cake\I18n\Time $from_date
 * @property \Cake\I18n\Time $to_date
 * @property int $is_current_job
 * @property string $description
 * @property int $rank
 * @property int $displayme
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Candidates\Model\Entity\User $user
 */
class UserEmployment extends Entity
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
