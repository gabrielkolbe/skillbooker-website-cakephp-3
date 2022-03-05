<?php
namespace Candidates\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserAvailability Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Candidates\Model\Entity\UserAvailability get($primaryKey, $options = [])
 * @method \Candidates\Model\Entity\UserAvailability newEntity($data = null, array $options = [])
 * @method \Candidates\Model\Entity\UserAvailability[] newEntities(array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserAvailability|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Candidates\Model\Entity\UserAvailability patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserAvailability[] patchEntities($entities, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserAvailability findOrCreate($search, callable $callback = null, $options = [])
 */
class UserAvailabilityTable extends Table
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

        $this->table('user_availability');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Manager.Users'
        ]);
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
            ->date('event_date')
            ->requirePresence('event_date', 'create')
            ->notEmpty('event_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
