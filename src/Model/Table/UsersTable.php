<?php
namespace App\Model\Table;

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
 * @property \Cake\ORM\Association\HasMany $Candidates
 * @property \Cake\ORM\Association\HasMany $Jobapplications
 * @property \Cake\ORM\Association\HasMany $Jobs
 * @property \Cake\ORM\Association\HasMany $UserArticleCategories
 * @property \Cake\ORM\Association\HasMany $UserArticles
 * @property \Cake\ORM\Association\HasMany $UserAvailability
 * @property \Cake\ORM\Association\HasMany $UserEmployments
 * @property \Cake\ORM\Association\HasMany $UserPublications
 * @property \Cake\ORM\Association\HasMany $UserQualifications
 * @property \Cake\ORM\Association\HasMany $UserResumes
 * @property \Cake\ORM\Association\HasMany $UserSkills
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
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

        $this->belongsTo('Communicationsettings', [
            'foreignKey' => 'communicationsetting_id'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id'
        ]);
        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id'
        ]);
        $this->hasMany('Candidates', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);
        $this->hasMany('Jobapplications', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);


        $this->hasMany('UserArticles', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);
        $this->hasMany('UserAvailability', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);
        $this->hasMany('UserEmployments', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);
        $this->hasMany('UserPublications', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);
        $this->hasMany('UserQualifications', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);
        $this->hasMany('UserResumes', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);
        $this->hasMany('UserSkills', [
          'foreignKey' => 'user_id',
          'dependent' => true,
          'cascadeCallbacks' => true
        ]);
        
        $this->hasMany('Jobs', [
            'foreignKey' => 'job_id',
            'className' => 'Jobboard.Jobs'
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
            ->allowEmpty('name');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->allowEmpty('validate_string');


        return $validator;
    }
    
    
    
    public function validationVerify(Validator $validator)
    {
        $validator
            ->requirePresence('country_id', 'create')
            ->notEmpty('country_id');

            
        $validator
            ->requirePresence('industry_id', 'create')
            ->notEmpty('industry_id');


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
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }
}
