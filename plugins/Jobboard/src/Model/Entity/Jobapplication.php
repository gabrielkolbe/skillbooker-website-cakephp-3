<?php
namespace Jobboard\Model\Entity;

use Cake\ORM\Entity;

/**
 * Jobapplication Entity
 *
 * @property int $id
 * @property int $job_id
 * @property int $user_id
 * @property int $applicationstatus_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Jobboard\Model\Entity\Job $job
 * @property \Jobboard\Model\Entity\User $user
 * @property \Jobboard\Model\Entity\Applicationstatus $applicationstatus
 */
class Jobapplication extends Entity
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
