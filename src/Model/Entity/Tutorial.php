<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tutorial Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $tutorial_category_id
 * @property int $status
 * @property string $short
 * @property string $content
 * @property string $source
 * @property int $twittercount
 * @property int $hitcount
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\TutorialCategory $tutorial_category
 * @property \App\Model\Entity\TutorialComment[] $tutorial_comments
 * @property \App\Model\Entity\TutorialImage[] $tutorial_images
 */
class Tutorial extends Entity
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
