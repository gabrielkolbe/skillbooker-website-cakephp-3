<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Messenger Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $sender_email
 * @property int $receiver_id
 * @property string $receiver_email
 * @property string $title
 * @property string $message
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Receiver $receiver
 */
class Messenger extends Entity
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
