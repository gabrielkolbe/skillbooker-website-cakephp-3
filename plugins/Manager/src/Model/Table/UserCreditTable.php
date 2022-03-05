<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserCredit Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \manager\Model\Entity\UserCredit get($primaryKey, $options = [])
 * @method \manager\Model\Entity\UserCredit newEntity($data = null, array $options = [])
 * @method \manager\Model\Entity\UserCredit[] newEntities(array $data, array $options = [])
 * @method \manager\Model\Entity\UserCredit|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \manager\Model\Entity\UserCredit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \manager\Model\Entity\UserCredit[] patchEntities($entities, array $data, array $options = [])
 * @method \manager\Model\Entity\UserCredit findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserCreditTable extends Table
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

        $this->table('user_credit');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'manager.Users'
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
            ->integer('jobs')
            ->allowEmpty('jobs');

        $validator
            ->allowEmpty('subscriptionlevel');

        $validator
            ->date('subscriptiondate')
            ->allowEmpty('subscriptiondate');

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
