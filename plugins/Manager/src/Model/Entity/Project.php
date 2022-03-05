<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $industry_id
 * @property int $user_id
 * @property int $awardeduser
 * @property int $projecttype
 * @property int $currency_id
 * @property string $denomination
 * @property string $currency_abbrev
 * @property float $amount
 * @property string $stage1
 * @property string $stage2
 * @property string $stage3
 * @property string $stage4
 * @property string $short_description
 * @property int $twittercount
 * @property string $status
 * @property int $bids
 * @property string $skills
 * @property string $date_human
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Currency $currency
 */
class Project extends Entity
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
