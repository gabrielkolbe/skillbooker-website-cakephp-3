<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Contactmethods
 * @property \Cake\ORM\Association\BelongsTo $Contactcategories
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\HasMany $Companies
 * @property \Cake\ORM\Association\HasMany $Jobs
 *
 * @method \Jobs\Model\Entity\Company get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompaniesTable extends Table
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

        $this->table('companies');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Contactmethods', [
            'foreignKey' => 'contactmethod_id',
            'className' => 'Jobs.Contactmethods'
        ]);

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
            'className' => 'Jobs.States'
        ]);
        
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
            'className' => 'Jobs.Countries'
        ]);

        $this->hasMany('Jobs', [
            'foreignKey' => 'company_id',
            'className' => 'Jobs.Jobs'
        ]);
        
        $this->hasMany('Candidates', [
            'foreignKey' => 'company_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');

        $validator
            ->requirePresence('contact', 'create')
            ->notEmpty('contact');

        $validator
            ->allowEmpty('position');


        $validator
            ->allowEmpty('reportto');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('landline');

        $validator
            ->allowEmpty('mobile');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->requirePresence('town', 'create')
            ->notEmpty('town');

        $validator
            ->requirePresence('postcode', 'create')
            ->notEmpty('postcode');

        $validator
            ->allowEmpty('notes');

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
        $rules->add($rules->existsIn(['contactmethod_id'], 'Contactmethods'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
