<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $firstname
 * @property string $lastname
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $password
 * @property int $status
 * @property int $verified
 * @property int $country_id
 * @property int $state_id
 * @property string $town
 * @property string $jobtitle
 * @property string $company
 * @property string $avatar
 * @property string $validate_string
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Activity[] $activity
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Group[] $groups
 * @property \App\Model\Entity\Region[] $regions
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
