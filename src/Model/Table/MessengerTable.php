<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Messengers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Receivers
 *
 * @method \App\Model\Entity\Messenger get($primaryKey, $options = [])
 * @method \App\Model\Entity\Messenger newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Messenger[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Messenger|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Messenger patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Messenger[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Messenger findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessengersTable extends Table
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

        $this->table('messengers');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Senders', [
            'foreignKey' => 'sender_id',
            'joinType' => 'LEFT',
            'className' => 'Users'
        ]);
        
        $this->belongsTo('Receivers', [
            'foreignKey' => 'receiver_id',
            'joinType' => 'LEFT',
            'className' => 'Users'
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
            ->requirePresence('sender_email', 'create')
            ->notEmpty('sender_email');

        $validator
            ->requirePresence('receiver_email', 'create')
            ->notEmpty('receiver_email');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('message', 'create')
            ->notEmpty('message');

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
        $rules->add($rules->existsIn(['sender_id'], 'Users'));
        $rules->add($rules->existsIn(['receiver_id'], 'Users'));

        return $rules;
    }
}
