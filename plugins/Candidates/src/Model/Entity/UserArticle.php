<?php
namespace Candidates\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserArticle Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $slug
 * @property int $user_article_category_id
 * @property int $status
 * @property string $short
 * @property string $content
 * @property string $source
 * @property int $twittercount
 * @property int $hitcount
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Candidates\Model\Entity\User $user
 * @property \Candidates\Model\Entity\UserArticleCategory $user_article_category
 * @property \Candidates\Model\Entity\Image[] $images
 */
class UserArticle extends Entity
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
