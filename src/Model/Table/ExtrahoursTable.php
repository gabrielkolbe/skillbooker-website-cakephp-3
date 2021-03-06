<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Extrahours Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\Extrahour get($primaryKey, $options = [])
 * @method \App\Model\Entity\Extrahour newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Extrahour[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Extrahour|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Extrahour patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Extrahour[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Extrahour findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExtrahoursTable extends Table
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

        $this->table('extrahours');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
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
            ->integer('hours')
            ->requirePresence('hours', 'create')
            ->notEmpty('hours');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->integer('freelancer')
            ->requirePresence('freelancer', 'create')
            ->notEmpty('freelancer');

        $validator
            ->requirePresence('notes', 'create')
            ->notEmpty('notes');

        $validator
            ->requirePresence('denomination', 'create')
            ->notEmpty('denomination');

        $validator
            ->requirePresence('currency_abbrev', 'create')
            ->notEmpty('currency_abbrev');

        $validator
            ->integer('completed')
            ->requirePresence('completed', 'create')
            ->notEmpty('completed');

        $validator
            ->integer('cost')
            ->requirePresence('cost', 'create')
            ->notEmpty('cost');

        $validator
            ->integer('paid')
            ->requirePresence('paid', 'create')
            ->notEmpty('paid');

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
        $rules->add($rules->existsIn(['project_id'], 'Projects'));

        return $rules;
    }
}
