<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Recruitmentprogress Model
 *
 * @method \Jobs\Model\Entity\Recruitmentprogres get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Recruitmentprogres newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Recruitmentprogres[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Recruitmentprogres|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Recruitmentprogres patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Recruitmentprogres[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Recruitmentprogres findOrCreate($search, callable $callback = null, $options = [])
 */
class RecruitmentprogressTable extends Table
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

        $this->table('recruitmentprogress');
        $this->displayField('name');
        $this->primaryKey('id');
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
