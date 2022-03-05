<?php
namespace Jobs\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $company
 * @property string $firstname
 * @property string $lastname
 * @property string $contact
 * @property string $position
 * @property string $imported_company
 * @property string $reportto
 * @property int $contactmethod_id
 * @property int $contactcategory_id
 * @property int $company_id
 * @property string $email
 * @property string $landline
 * @property string $mobile
 * @property string $address
 * @property int $state_id
 * @property string $town
 * @property string $postcode
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Jobs\Model\Entity\Contactmethod $contactmethod
 * @property \Jobs\Model\Entity\Contactcategory $contactcategory
 * @property \Jobs\Model\Entity\Company[] $companies
 * @property \Jobs\Model\Entity\State $state
 * @property \Jobs\Model\Entity\Job[] $jobs
 */
class Company extends Entity
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
