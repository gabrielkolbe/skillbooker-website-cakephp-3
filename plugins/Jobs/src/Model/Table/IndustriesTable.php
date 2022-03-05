<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Industries Model
 *
 * @property \Cake\ORM\Association\HasMany $Jobs
 * @property \Cake\ORM\Association\HasMany $Subindustries
 *
 * @method \Jobs\Model\Entity\Industry get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Industry newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Industry[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Industry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Industry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Industry[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Industry findOrCreate($search, callable $callback = null, $options = [])
 */
class IndustriesTable extends Table
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

        $this->table('industries');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Jobs', [
            'foreignKey' => 'industry_id',
            'className' => 'Jobs.Jobs'
        ]);
        
        $this->hasMany('Candidates', [
            'foreignKey' => 'industry_id',
            'className' => 'Jobs.Candidates'
        ]);
        $this->hasMany('Subindustries', [
            'foreignKey' => 'industry_id',
            'className' => 'Jobs.Subindustries'
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
