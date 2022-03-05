<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Salesoptions Model
 *
 * @method \Manager\Model\Entity\Salesoption get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\Salesoption newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\Salesoption[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\Salesoption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\Salesoption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\Salesoption[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\Salesoption findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesoptionsTable extends Table
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

        $this->table('salesoptions');
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

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->requirePresence('level', 'create')
            ->notEmpty('level');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->integer('realvalue')
            ->requirePresence('realvalue', 'create')
            ->notEmpty('realvalue');

        $validator
            ->requirePresence('savevalue', 'create')
            ->notEmpty('savevalue');

        return $validator;
    }
}
