<?php
namespace Manager\Model\Entity;

use Cake\ORM\Entity;

/**
 * State Entity
 *
 * @property int $id
 * @property string $county
 * @property int $country_id
 *
 * @property \Basic\Model\Entity\Country $country
 * @property \Basic\Model\Entity\User[] $users
 */
class State extends Entity
{

}
