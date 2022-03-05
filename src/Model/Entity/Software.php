<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Software Entity
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $software_pricetype_id
 * @property int $software_category_id
 * @property int $software_numberuser_id
 * @property int $software_numberemployee_id
 * @property string $software_support
 * @property string $software_demooption
 * @property string $software_deployment
 * @property string $software_training
 * @property int $priceperuser
 * @property int $freeversion
 * @property int $freetrail
 * @property int $demoavailable
 * @property int $rating
 * @property string $short_description
 * @property string $long_description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\SoftwareFeature[] $software_features
 * @property \App\Model\Entity\SoftwarePricetype $software_pricetype
 * @property \App\Model\Entity\SoftwareCategory $software_category
 * @property \App\Model\Entity\SoftwareNumberuser $software_numberuser
 * @property \App\Model\Entity\SoftwareNumberemployee $software_numberemployee
 * @property \App\Model\Entity\SoftwareDeployment[] $software_deployments
 * @property \App\Model\Entity\SoftwareSupport[] $software_supports
 * @property \App\Model\Entity\SoftwareDemooption[] $software_demooptions
 * @property \App\Model\Entity\SoftwareTraining[] $software_trainings
 */
class Software extends Entity
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
