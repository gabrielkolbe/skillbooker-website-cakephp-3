<?php
namespace App\Model\Entity;

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
 * @property int $sex
 * @property string $password
 * @property string $bio
 * @property int $status
 * @property int $verified
 * @property string $address1
 * @property string $address2
 * @property int $country_id
 * @property int $state_id
 * @property string $town
 * @property string $postcode
 * @property string $longitude
 * @property string $latitude
 * @property string $jobtitle
 * @property string $company
 * @property string $telephone
 * @property string $mobile
 * @property string $avatar
 * @property string $validate_string
 * @property int $receive_emails
 * @property int $receive_broadcast
 * @property \Cake\I18n\Time $dob
 * @property \Cake\I18n\Time $lastvisit
 * @property string $display_state
 * @property string $display_country
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Candidate[] $candidates
 * @property \App\Model\Entity\Jobapplication[] $jobapplications
 * @property \App\Model\Entity\Job[] $jobs
 * @property \App\Model\Entity\UserArticleCategory[] $user_article_categories
 * @property \App\Model\Entity\UserArticle[] $user_articles
 * @property \App\Model\Entity\UserAvailability[] $user_availability
 * @property \App\Model\Entity\UserEducation[] $user_educations
 * @property \App\Model\Entity\UserEmployment[] $user_employments
 * @property \App\Model\Entity\UserPublication[] $user_publications
 * @property \App\Model\Entity\UserQualification[] $user_qualifications
 * @property \App\Model\Entity\UserResume[] $user_resumes
 * @property \App\Model\Entity\UserSkill[] $user_skills
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
