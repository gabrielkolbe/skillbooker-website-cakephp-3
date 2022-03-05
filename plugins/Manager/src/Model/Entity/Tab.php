<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tab Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $isdefault
 * @property int $iscustom
 * @property int $changestate
 * @property string $change_title
 * @property string $change_url
 * @property int $displayorder
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Manager\Model\Entity\Navigation[] $navigations
 */
class Tab extends Entity
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
