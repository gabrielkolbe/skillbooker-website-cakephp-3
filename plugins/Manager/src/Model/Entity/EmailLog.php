<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailLog Entity
 *
 * @property int $id
 * @property int $receiver
 * @property string $receiver_email
 * @property int $sender
 * @property string $sender_email
 * @property int $email_template_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Manager\Model\Entity\EmailTemplate $email_template
 */
class EmailLog extends Entity
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
