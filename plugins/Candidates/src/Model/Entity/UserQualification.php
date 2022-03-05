<?php
namespace Candidates\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserQualification Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $country_id
 * @property string $type_of_qualification
 * @property string $institution
 * @property \Cake\I18n\Time $from_date
 * @property \Cake\I18n\Time $to_date
 * @property string $field
 * @property string $comments
 * @property int $rank
 * @property int $displayme
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Candidates\Model\Entity\User $user
 * @property \Candidates\Model\Entity\Country $country
 */
class UserQualification extends Entity
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
