<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timesheet Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $stime
 * @property \Cake\I18n\Time $ftime
 * @property int $break
 * @property int $saturday
 * @property int $sunday
 * @property \Cake\I18n\Time $currentmonth
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Timesheet extends Entity
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
