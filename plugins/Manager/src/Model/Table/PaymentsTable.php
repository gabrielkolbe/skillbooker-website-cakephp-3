<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payments Model
 *
 * @method \Manager\Model\Entity\Payment get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\Payment newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\Payment[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\Payment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\Payment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\Payment[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\Payment findOrCreate($search, callable $callback = null, $options = [])
 */
class PaymentsTable extends Table
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

        $this->table('payments');
        $this->displayField('id');
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
            ->requirePresence('txnid', 'create')
            ->notEmpty('txnid');

        $validator
            ->requirePresence('item_name', 'create')
            ->notEmpty('item_name');

        $validator
            ->requirePresence('item_number', 'create')
            ->notEmpty('item_number');

        $validator
            ->decimal('payment_amount')
            ->requirePresence('payment_amount', 'create')
            ->notEmpty('payment_amount');

        $validator
            ->requirePresence('payment_status', 'create')
            ->notEmpty('payment_status');

        $validator
            ->requirePresence('payment_currency', 'create')
            ->notEmpty('payment_currency');

        $validator
            ->requirePresence('receiver_email', 'create')
            ->notEmpty('receiver_email');

        $validator
            ->requirePresence('payer_email', 'create')
            ->notEmpty('payer_email');

        $validator
            ->dateTime('createdtime')
            ->requirePresence('createdtime', 'create')
            ->notEmpty('createdtime');

        return $validator;
    }
}
