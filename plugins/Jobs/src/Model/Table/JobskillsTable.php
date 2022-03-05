<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobskills Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Jobs
 * @property \Cake\ORM\Association\BelongsTo $Skills
 *
 * @method \Jobs\Model\Entity\Jobskill get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Jobskill newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Jobskill[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobskill|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Jobskill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobskill[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobskill findOrCreate($search, callable $callback = null, $options = [])
 */
class JobskillsTable extends Table
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

        $this->table('jobskills');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Jobs', [
            'foreignKey' => 'job_id',
            'joinType' => 'INNER',
            'className' => 'Jobs.Jobs'
        ]);
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
            'className' => 'Jobs.Skills'
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
            ->requirePresence('skill_name', 'create')
            ->notEmpty('skill_name');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

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
        $rules->add($rules->existsIn(['job_id'], 'Jobs'));
        $rules->add($rules->existsIn(['skill_id'], 'Skills'));

        return $rules;
    }
}
