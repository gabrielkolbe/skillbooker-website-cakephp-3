<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * TutorialImage Entity
 *
 * @property int $id
 * @property int $tutorial_id
 * @property string $location
 * @property string $photo
 * @property string $alttag
 *
 * @property \Manager\Model\Entity\Tutorial $tutorial
 */
class TutorialImage extends Entity
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
