<?php
namespace Candidates\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserArticleCategory Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $category
 * @property int $tutorial_count
 * @property string $slug
 * @property string $color
 * @property int $catorder
 *
 * @property \Candidates\Model\Entity\User $user
 * @property \Candidates\Model\Entity\UserArticle[] $user_articles
 */
class UserArticleCategory extends Entity
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
