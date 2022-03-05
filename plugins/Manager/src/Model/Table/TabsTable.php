<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tabs Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Navigations
 *
 * @method \Manager\Model\Entity\Tab get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\Tab newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\Tab[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\Tab|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\Tab patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\Tab[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\Tab findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TabsTable extends Table
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

        $this->table('tabs');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Navigations', [
            'foreignKey' => 'tab_id',
            'targetForeignKey' => 'navigation_id',
            'joinTable' => 'navigations_tabs',
            'className' => 'Manager.Navigations'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('urlcontroller', 'create')
            ->notEmpty('urlcontroller');
            
        $validator
            ->requirePresence('urlview', 'create')
            ->notEmpty('urlview');
            
        $validator
            ->requirePresence('changestate', 'create')
            ->notEmpty('changestate');
            
            
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
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }
}
