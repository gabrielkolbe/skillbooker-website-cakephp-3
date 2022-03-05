<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobsources Model
 *
 * @property \Cake\ORM\Association\HasMany $Jobs
 *
 * @method \Jobs\Model\Entity\Jobsource get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Jobsource newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Jobsource[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobsource|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Jobsource patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobsource[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobsource findOrCreate($search, callable $callback = null, $options = [])
 */
class JobsourcesTable extends Table
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

        $this->table('jobsources');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Jobs', [
            'foreignKey' => 'jobsource_id',
            'className' => 'Jobs.Jobs'
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

        return $validator;
    }
}
