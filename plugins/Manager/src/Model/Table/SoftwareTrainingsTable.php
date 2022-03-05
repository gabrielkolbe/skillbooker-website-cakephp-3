<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SoftwareTrainings Model
 *
 * @method \Softmarket\Model\Entity\SoftwareTraining get($primaryKey, $options = [])
 * @method \Softmarket\Model\Entity\SoftwareTraining newEntity($data = null, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareTraining[] newEntities(array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareTraining|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Softmarket\Model\Entity\SoftwareTraining patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareTraining[] patchEntities($entities, array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareTraining findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SoftwareTrainingsTable extends Table
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

        $this->table('software_trainings');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
