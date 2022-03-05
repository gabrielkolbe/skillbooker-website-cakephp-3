<?php
namespace Jobs\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subindustry Entity
 *
 * @property int $id
 * @property int $industry_id
 * @property string $name
 *
 * @property \Jobs\Model\Entity\Industry $industry
 * @property \Jobs\Model\Entity\Job[] $jobs
 */
class Subindustry extends Entity
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
