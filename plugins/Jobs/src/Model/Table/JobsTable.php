<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Jobtypes
 * @property \Cake\ORM\Association\BelongsTo $Jobstatuses
 * @property \Cake\ORM\Association\BelongsTo $Jobsalarytypes
 * @property \Cake\ORM\Association\BelongsTo $Jobsalarydescs
 * @property \Cake\ORM\Association\BelongsTo $Jobdatedescs
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\BelongsTo $Subindustries
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $JobSkills
 * @property \Cake\ORM\Association\HasMany $Jobapplications
 *
 * @method \Jobs\Model\Entity\Job get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Job newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Job[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Job|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Job patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Job[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Job findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JobsTable extends Table
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

        $this->table('jobs');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Jobs.Users'
        ]);
        $this->belongsTo('Jobtypes', [
            'foreignKey' => 'jobtype_id',
            'className' => 'Jobs.Jobtypes'
        ]);
        $this->belongsTo('Recruitmentprogress', [
            'foreignKey' => 'recruitmentprogress_id',
            'className' => 'Jobs.Recruitmentprogress'
        ]);
        $this->belongsTo('Paymentintervals', [
            'foreignKey' => 'paymentinterval_id',
            'className' => 'Jobs.Paymentintervals'
        ]);
        $this->belongsTo('Salarydescs', [
            'foreignKey' => 'salarydesc_id',
            'className' => 'Jobs.Salarydescs'
        ]);
        $this->belongsTo('Jobsources', [
            'foreignKey' => 'jobsource_id',
            'className' => 'Jobs.Jobsources'
        ]);
        $this->belongsTo('Datedescs', [
            'foreignKey' => 'datedesc_id',
            'className' => 'Jobs.Datedescs'
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'className' => 'Jobs.Companies'
        ]);
        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'className' => 'Jobs.Industries'
        ]);
        $this->belongsTo('Subindustries', [
            'foreignKey' => 'subindustry_id',
            'className' => 'Jobs.Subindustries'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'className' => 'Jobs.States'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
            'className' => 'Jobs.Countries'
        ]);
        $this->hasMany('Jobskills', [
            'foreignKey' => 'job_id',
            'className' => 'Jobs.Jobskills'
        ]);
        $this->hasMany('Jobapplications', [
            'foreignKey' => 'job_id',
            'className' => 'Jobs.Jobapplications'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');
            
        $validator
            ->allowEmpty('currency');

        $validator
            ->allowEmpty('min_salary');

        $validator
            ->allowEmpty('max_salary');

        $validator
            ->allowEmpty('salary');

        $validator
            ->allowEmpty('description');

        $validator
            ->date('startdate')
            ->allowEmpty('startdate');

        $validator
            ->allowEmpty('datedisplay');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('state');

        $validator
            ->allowEmpty('reference');


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
        $rules->add($rules->existsIn(['jobtype_id'], 'Jobtypes'));
        $rules->add($rules->existsIn(['salarydesc_id'], 'Salarydescs'));
        $rules->add($rules->existsIn(['datedesc_id'], 'Datedescs'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        $rules->add($rules->existsIn(['subindustry_id'], 'Subindustries'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
}
