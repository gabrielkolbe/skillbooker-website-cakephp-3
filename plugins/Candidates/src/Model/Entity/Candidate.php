<?php
namespace Candidates\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidate Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $candidate_status_id
 * @property int $candidate_rating_id
 * @property int $candidate_source_id
 * @property \Cake\I18n\Time $available_from
 * @property int $company_id
 * @property string $current_company
 * @property int $jobtype_id
 * @property int $contactmethod_id
 * @property string $current_position
 * @property string $current_salary
 * @property string $ideal_position
 * @property string $ideal_location
 * @property string $ideal_salary
 * @property string $linkedin
 * @property string $facebook
 * @property string $googleplus
 * @property string $twitter
 * @property string $website
 * @property string $summary
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Candidates\Model\Entity\User $user
 * @property \Candidates\Model\Entity\CandidateStatus $candidate_status
 * @property \Candidates\Model\Entity\CandidateRating $candidate_rating
 * @property \Candidates\Model\Entity\CandidateSource $candidate_source
 * @property \Candidates\Model\Entity\Company $company
 * @property \Candidates\Model\Entity\Jobtype $jobtype
 * @property \Candidates\Model\Entity\Contactmethod $contactmethod
 */
class Candidate extends Entity
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
