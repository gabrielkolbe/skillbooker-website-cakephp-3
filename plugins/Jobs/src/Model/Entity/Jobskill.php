<?php
namespace Jobs\Model\Entity;

use Cake\ORM\Entity;

/**
 * Jobskill Entity
 *
 * @property int $id
 * @property int $job_id
 * @property int $skill_id
 * @property string $skill_name
 * @property string $slug
 *
 * @property \Jobs\Model\Entity\Job $job
 * @property \Jobs\Model\Entity\Skill $skill
 */
class Jobskill extends Entity
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
