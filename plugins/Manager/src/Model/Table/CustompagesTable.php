<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Custompages Model
 *
 * @method \Basic\Model\Entity\Custompage get($primaryKey, $options = [])
 * @method \Basic\Model\Entity\Custompage newEntity($data = null, array $options = [])
 * @method \Basic\Model\Entity\Custompage[] newEntities(array $data, array $options = [])
 * @method \Basic\Model\Entity\Custompage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Basic\Model\Entity\Custompage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Basic\Model\Entity\Custompage[] patchEntities($entities, array $data, array $options = [])
 * @method \Basic\Model\Entity\Custompage findOrCreate($search, callable $callback = null)
 */
class CustompagesTable extends Table
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

        $this->table('custompages');
        $this->displayField('title');
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');


        return $validator;
    }
}
