<?php
namespace Candidates\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserStatuses Model
 *
 * @method \Candidates\Model\Entity\UserStatus get($primaryKey, $options = [])
 * @method \Candidates\Model\Entity\UserStatus newEntity($data = null, array $options = [])
 * @method \Candidates\Model\Entity\UserStatus[] newEntities(array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Candidates\Model\Entity\UserStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class UserStatusesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('user_statuses');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
