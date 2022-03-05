<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Paymentintervals Model
 *
 * @method \Jobs\Model\Entity\Paymentinterval get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Paymentinterval newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Paymentinterval[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Paymentinterval|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Paymentinterval patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Paymentinterval[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Paymentinterval findOrCreate($search, callable $callback = null, $options = [])
 */
class PaymentintervalsTable extends Table
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

        $this->table('paymentintervals');
        $this->displayField('name');
        $this->primaryKey('id');
        
        $this->hasMany('Jobs', [
            'foreignKey' => 'paymentinterval_id',
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
