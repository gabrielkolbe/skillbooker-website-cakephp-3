<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InvoiceEntries Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Invoices
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Invoicetracker\Model\Entity\InvoiceEntry get($primaryKey, $options = [])
 * @method \Invoicetracker\Model\Entity\InvoiceEntry newEntity($data = null, array $options = [])
 * @method \Invoicetracker\Model\Entity\InvoiceEntry[] newEntities(array $data, array $options = [])
 * @method \Invoicetracker\Model\Entity\InvoiceEntry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Invoicetracker\Model\Entity\InvoiceEntry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Invoicetracker\Model\Entity\InvoiceEntry[] patchEntities($entities, array $data, array $options = [])
 * @method \Invoicetracker\Model\Entity\InvoiceEntry findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InvoiceEntriesTable extends Table
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

        $this->table('invoice_entries');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Invoices', [
            'foreignKey' => 'invoice_id',
            'joinType' => 'INNER',
            'className' => 'Invoicetracker.Invoices'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Invoicetracker.Users'
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
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->integer('lineprice')
            ->requirePresence('lineprice', 'create')
            ->notEmpty('lineprice');

        $validator
            ->integer('totallineprice')
            ->requirePresence('totallineprice', 'create')
            ->notEmpty('totallineprice');

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
        $rules->add($rules->existsIn(['invoice_id'], 'Invoices'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
