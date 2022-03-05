<?php
namespace Candidates\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserEmployments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Candidates\Model\Entity\UserEmployment get($primaryKey, $options = [])
 * @method \Candidates\Model\Entity\UserEmployment newEntity($data = null, array $options = [])
 * @method \Candidates\Model\Entity\UserEmployment[] newEntities(array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserEmployment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Candidates\Model\Entity\UserEmployment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserEmployment[] patchEntities($entities, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserEmployment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserEmploymentsTable extends Table
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

        $this->table('user_employments');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Candidates.Users'
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
            ->requirePresence('position', 'create')
            ->notEmpty('position');

        $validator
            ->allowEmpty('company');

        $validator
            ->allowEmpty('job_location');

        $validator
            ->date('from_date')
            ->allowEmpty('from_date');

        $validator
            ->date('to_date')
            ->allowEmpty('to_date');

        $validator
            ->integer('is_current_job')
            ->allowEmpty('is_current_job');

        $validator
            ->allowEmpty('description');

        $validator
            ->integer('rank')
            ->requirePresence('rank', 'create')
            ->notEmpty('rank');

        $validator
            ->integer('displayme')
            ->requirePresence('displayme', 'create')
            ->notEmpty('displayme');

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
