<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TimesheetUser Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $registereduserid
 * @property int $role_id
 * @property string $firstname
 * @property string $lastname
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $signature
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Role $role
 */
class TimesheetUser extends Entity
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
