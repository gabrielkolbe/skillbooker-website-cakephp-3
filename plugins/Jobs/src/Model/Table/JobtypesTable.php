<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobtypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Candidates
 * @property \Cake\ORM\Association\HasMany $Jobs
 *
 * @method \Jobs\Model\Entity\Jobtype get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Jobtype newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Jobtype[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobtype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Jobtype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobtype[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Jobtype findOrCreate($search, callable $callback = null, $options = [])
 */
class JobtypesTable extends Table
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

        $this->table('jobtypes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Candidates', [
            'foreignKey' => 'jobtype_id',
            'className' => 'Jobs.Candidates'
        ]);
        $this->hasMany('Jobs', [
            'foreignKey' => 'jobtype_id',
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
