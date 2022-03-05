<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SoftwareCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $SoftwareFeatures
 * @property \Cake\ORM\Association\HasMany $Softwares
 *
 * @method \Softmarket\Model\Entity\SoftwareCategory get($primaryKey, $options = [])
 * @method \Softmarket\Model\Entity\SoftwareCategory newEntity($data = null, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareCategory[] newEntities(array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Softmarket\Model\Entity\SoftwareCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SoftwareCategoriesTable extends Table
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

        $this->table('software_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('SoftwareFeatures', [
            'foreignKey' => 'software_category_id',
            'className' => 'Softmarket.SoftwareFeatures'
        ]);
        $this->hasMany('Softwares', [
            'foreignKey' => 'software_category_id',
            'className' => 'Softmarket.Softwares'
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
            ->requirePresence('slug', 'create')
            ->notEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
