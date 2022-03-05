<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Urlviews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Urlcontrollers
 *
 * @method \Manager\Model\Entity\Urlview get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\Urlview newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\Urlview[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\Urlview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\Urlview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\Urlview[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\Urlview findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UrlviewsTable extends Table
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

        $this->table('urlviews');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Urlcontrollers', [
            'foreignKey' => 'urlcontroller_id',
            'joinType' => 'INNER',
            'className' => 'Manager.Urlcontrollers'
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['urlcontroller_id'], 'Urlcontrollers'));

        return $rules;
    }
}
