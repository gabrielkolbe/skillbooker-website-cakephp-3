<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * States Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \Basic\Model\Entity\State get($primaryKey, $options = [])
 * @method \Basic\Model\Entity\State newEntity($data = null, array $options = [])
 * @method \Basic\Model\Entity\State[] newEntities(array $data, array $options = [])
 * @method \Basic\Model\Entity\State|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Basic\Model\Entity\State patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Basic\Model\Entity\State[] patchEntities($entities, array $data, array $options = [])
 * @method \Basic\Model\Entity\State findOrCreate($search, callable $callback = null)
 */
class StatesTable extends Table
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

        $this->table('states');
        $this->displayField('name');
        $this->primaryKey('id');
        
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'state_id'
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
            ->requirePresence('id', 'create')
            ->notEmpty('id')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            
        $validator
            ->requirePresence('country_id', 'create')
            ->notEmpty('country_id');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
}
