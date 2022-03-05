<?php
namespace Jobboard\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Jobtypes
 * @property \Cake\ORM\Association\BelongsTo $Paymentintervals
 * @property \Cake\ORM\Association\BelongsTo $Jobsources
 * @property \Cake\ORM\Association\BelongsTo $Salarydescs
 * @property \Cake\ORM\Association\BelongsTo $Datedescs
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\BelongsTo $Subindustries
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $Jobapplications
 * @property \Cake\ORM\Association\HasMany $Jobskills
 *
 * @method \Jobboard\Model\Entity\Job get($primaryKey, $options = [])
 * @method \Jobboard\Model\Entity\Job newEntity($data = null, array $options = [])
 * @method \Jobboard\Model\Entity\Job[] newEntities(array $data, array $options = [])
 * @method \Jobboard\Model\Entity\Job|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobboard\Model\Entity\Job patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobboard\Model\Entity\Job[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobboard\Model\Entity\Job findOrCreate($search, callable $callback = null, $options = [])
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
            'className' => 'Jobboard.Users'
        ]);
        $this->belongsTo('Jobtypes', [
            'foreignKey' => 'jobtype_id',
            'className' => 'Jobboard.Jobtypes'
        ]);
        $this->belongsTo('Paymentintervals', [
            'foreignKey' => 'paymentinterval_id',
            'className' => 'Jobboard.Paymentintervals'
        ]);

        $this->belongsTo('Salarydescs', [
            'foreignKey' => 'salarydesc_id',
            'className' => 'Jobboard.Salarydescs'
        ]);
        $this->belongsTo('Datedescs', [
            'foreignKey' => 'datedesc_id',
            'className' => 'Jobboard.Datedescs'
        ]);

        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'className' => 'Jobboard.Industries'
        ]);


        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
            'className' => 'Jobboard.Countries'
        ]);
        $this->hasMany('Jobapplications', [
            'foreignKey' => 'job_id',
            'className' => 'Jobboard.Jobapplications'
        ]);
        $this->hasMany('Jobskills', [
            'foreignKey' => 'job_id',
            'className' => 'Jobboard.Jobskills'
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
            ->allowEmpty('min_salary');

        $validator
            ->allowEmpty('max_salary');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->date('startdate')
            ->allowEmpty('startdate');

        $validator
            ->date('enddate')
            ->allowEmpty('enddate');

        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->allowEmpty('reference');


        $validator
            ->allowEmpty('display_date');

        $validator
            ->allowEmpty('display_salary');

        $validator
            ->allowEmpty('display_state');

        $validator
            ->requirePresence('display_country', 'create')
            ->notEmpty('display_country');

        $validator
            ->requirePresence('display_jobtype', 'create')
            ->notEmpty('display_jobtype');

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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
}
