<?php
namespace Candidates\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserAvailability Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\Time $event_date
 *
 * @property \Candidates\Model\Entity\User $user
 */
class UserAvailability extends Entity
{

}
