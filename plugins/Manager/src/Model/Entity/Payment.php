<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property string $txnid
 * @property string $item_name
 * @property string $item_number
 * @property float $payment_amount
 * @property string $payment_status
 * @property string $payment_currency
 * @property string $receiver_email
 * @property string $payer_email
 * @property \Cake\I18n\Time $createdtime
 */
class Payment extends Entity
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
