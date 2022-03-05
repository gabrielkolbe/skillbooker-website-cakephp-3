<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectTemplates Model
 *
 * @method \Manager\Model\Entity\ProjectTemplate get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\ProjectTemplate newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\ProjectTemplate[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\ProjectTemplate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\ProjectTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\ProjectTemplate[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\ProjectTemplate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectTemplatesTable extends Table
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

        $this->table('project_templates');
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
            ->notEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('stage1');

        $validator
            ->requirePresence('stage2', 'create')
            ->notEmpty('stage2');

        $validator
            ->requirePresence('stage3', 'create')
            ->notEmpty('stage3');

        $validator
            ->requirePresence('stage4', 'create')
            ->notEmpty('stage4');

        $validator
            ->requirePresence('short_description', 'create')
            ->notEmpty('short_description');

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
