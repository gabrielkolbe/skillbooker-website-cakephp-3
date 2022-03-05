<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Country Entity
 *
 * @property int $id
 * @property string $name
 * @property string $iso_alpha2
 * @property string $iso_alpha3
 * @property int $iso_numeric
 * @property string $country_currency
 * @property string $currency_name
 * @property string $currency_symbol
 * @property string $html_entity
 * @property string $flag
 * @property int $jobcount
 * @property int $displayme
 *
 * @property \Basic\Model\Entity\State[] $states
 * @property \Basic\Model\Entity\User[] $users
 */
class Country extends Entity
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
