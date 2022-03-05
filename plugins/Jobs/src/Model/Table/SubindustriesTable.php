<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subindustries Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\HasMany $Jobs
 *
 * @method \Jobs\Model\Entity\Subindustry get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Subindustry newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Subindustry[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Subindustry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Subindustry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Subindustry[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Subindustry findOrCreate($search, callable $callback = null, $options = [])
 */
class SubindustriesTable extends Table
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

        $this->table('subindustries');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'joinType' => 'INNER',
            'className' => 'Jobs.Industries'
        ]);
        $this->hasMany('Jobs', [
            'foreignKey' => 'subindustry_id',
            'className' => 'Jobs.Jobs'
        ]);
            $this->hasMany('Candidates', [
            'foreignKey' => 'subindustry_id',
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
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));

        return $rules;
    }
}
