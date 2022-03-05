<?php
namespace Jobs\Model\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property int $jobtype_id
 * @property int $jobstatus_id
 * @property int $jobsalarytype_id
 * @property string $currency
 * @property string $min_salary
 * @property string $max_salary
 * @property string $salary
 * @property int $jobsalarydesc_id
 * @property string $description
 * @property \Cake\I18n\Time $startdate
 * @property \Cake\I18n\Time $enddate
 * @property string $datedisplay
 * @property int $jobdatedesc_id
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
 *
 * @property \Jobs\Model\Entity\State $state
 * @property \Jobs\Model\Entity\User $user
 * @property \Jobs\Model\Entity\Jobtype $jobtype
 * @property \Jobs\Model\Entity\Jobstatus $jobstatus
 * @property \Jobs\Model\Entity\Jobsalarytype $jobsalarytype
 * @property \Jobs\Model\Entity\Jobsalarydesc $jobsalarydesc
 * @property \Jobs\Model\Entity\Jobdatedesc $jobdatedesc
 * @property \Jobs\Model\Entity\Company $company
 * @property \Jobs\Model\Entity\Industry $industry
 * @property \Jobs\Model\Entity\Subindustry $subindustry
 * @property \Jobs\Model\Entity\Country $country
 * @property \Jobs\Model\Entity\JobSkill[] $job_skills
 * @property \Jobs\Model\Entity\Jobapplication[] $jobapplications
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
