<?php
namespace Invoicetracker\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $InvoiceStatuses
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 * @property \Cake\ORM\Association\HasMany $InvoiceEntries
 *
 * @method \Invoicetracker\Model\Entity\Invoice get($primaryKey, $options = [])
 * @method \Invoicetracker\Model\Entity\Invoice newEntity($data = null, array $options = [])
 * @method \Invoicetracker\Model\Entity\Invoice[] newEntities(array $data, array $options = [])
 * @method \Invoicetracker\Model\Entity\Invoice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Invoicetracker\Model\Entity\Invoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Invoicetracker\Model\Entity\Invoice[] patchEntities($entities, array $data, array $options = [])
 * @method \Invoicetracker\Model\Entity\Invoice findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InvoicesTable extends Table
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

        $this->table('invoices');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Invoicetracker.Users'
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER',
            'className' => 'Invoicetracker.Companies'
        ]);
        $this->belongsTo('InvoiceStatuses', [
            'foreignKey' => 'invoice_status_id',
            'joinType' => 'INNER',
            'className' => 'Invoicetracker.InvoiceStatuses'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id',
            'className' => 'Invoicetracker.Currencies'
        ]);
        $this->hasMany('InvoiceEntries', [
            'foreignKey' => 'invoice_id',
            'className' => 'Invoicetracker.InvoiceEntries'
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

        $validator
            ->requirePresence('denomination', 'create')
            ->notEmpty('denomination');

        $validator
            ->requirePresence('currency_abbrev', 'create')
            ->notEmpty('currency_abbrev');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->allowEmpty('notes');

        $validator
            ->requirePresence('footernotes', 'create')
            ->notEmpty('footernotes');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['invoice_status_id'], 'InvoiceStatuses'));
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));

        return $rules;
    }
}
