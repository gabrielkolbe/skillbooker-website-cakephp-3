<?php
namespace Jobboard\Model\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property int $jobtype_id
 * @property int $paymentinterval_id
 * @property int $jobsource_id
 * @property string $min_salary
 * @property string $max_salary
 * @property int $salarydesc_id
 * @property string $description
 * @property \Cake\I18n\Time $startdate
 * @property \Cake\I18n\Time $enddate
 * @property int $datedesc_id
 * @property int $company_id
 * @property int $industry_id
 * @property int $subindustry_id
 * @property string $city
 * @property int $state_id
 * @property int $country_id
 * @property string $reference
 * @property int $twittercount
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $display_date
 * @property string $display_salary
 * @property string $display_state
 * @property string $display_country
 * @property string $display_jobtype
 *
 * @property \Jobboard\Model\Entity\User $user
 * @property \Jobboard\Model\Entity\Jobtype $jobtype
 * @property \Jobboard\Model\Entity\Paymentinterval $paymentinterval
 * @property \Jobboard\Model\Entity\Jobsource $jobsource
 * @property \Jobboard\Model\Entity\Salarydesc $salarydesc
 * @property \Jobboard\Model\Entity\Datedesc $datedesc
 * @property \Jobboard\Model\Entity\Company $company
 * @property \Jobboard\Model\Entity\Industry $industry
 * @property \Jobboard\Model\Entity\Subindustry $subindustry
 * @property \Jobboard\Model\Entity\State $state
 * @property \Jobboard\Model\Entity\Country $country
 * @property \Jobboard\Model\Entity\Jobapplication[] $jobapplications
 * @property \Jobboard\Model\Entity\Jobskill[] $jobskills
 */
class Job extends Entity
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
