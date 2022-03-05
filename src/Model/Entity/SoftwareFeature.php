<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SoftwareFeature Entity
 *
 * @property int $id
 * @property string $name
 * @property int $software_category_id
 *
 * @property \App\Model\Entity\SoftwareCategory $software_category
 * @property \App\Model\Entity\SoftwareDemooptionSoftware[] $software_demooption_softwares
 * @property \App\Model\Entity\SoftwareDeploymentSoftware[] $software_deployment_softwares
 * @property \App\Model\Entity\SoftwareFeatureSoftware[] $software_feature_softwares
 * @property \App\Model\Entity\SoftwareSupportSoftware[] $software_support_softwares
 * @property \App\Model\Entity\SoftwareTrainingSoftware[] $software_training_softwares
 */
class SoftwareFeature extends Entity
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
