<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\HasMany $Posts
 * @property \Cake\ORM\Association\BelongsToMany $Groups
 * @property \Cake\ORM\Association\BelongsToMany $Locations
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'LEFT'
        ]);

        $this->hasMany('Jobs', [
            'foreignKey' => 'user_id'
        ]);
        
        $this->hasMany('CandidateEducations', [
            'foreignKey' => 'user_id',
            'className' => 'Jobs.CandidateEducations'
        ]);
        $this->hasMany('CandidateEmployments', [
            'foreignKey' => 'user_id',
            'className' => 'Jobs.CandidateEmployments'
        ]);
        $this->hasMany('CandidateResumes', [
            'foreignKey' => 'user_id',
            'className' => 'Jobs.CandidateResumes'
        ]);
        $this->hasMany('CandidateSkills', [
            'foreignKey' => 'user_id',
            'className' => 'Jobs.CandidateSkills'
        ]);
        
        $this->hasMany('Candidates', [
            'foreignKey' => 'user_id',
            'className' => 'Jobs.Candidates'
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
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');
                        
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');


        return $validator;
    }
    
        public function validationVerify(Validator $validator)
    {
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');
            


        return $validator;
    }
    
    
    
        public function validationEmail(Validator $validator)
    {

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        return $validator;
    }
    
        public function validationAccount(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');


        $validator
            ->requirePresence('town', 'create')
            ->notEmpty('town');

        $validator
            ->requirePresence('jobtitle', 'create')
            ->notEmpty('jobtitle');

        $validator
            ->requirePresence('company', 'create')
            ->notEmpty('company');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
