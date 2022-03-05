<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProjectTemplate Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $stage1
 * @property string $stage2
 * @property string $stage3
 * @property string $stage4
 * @property string $short_description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ProjectTemplate extends Entity
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
