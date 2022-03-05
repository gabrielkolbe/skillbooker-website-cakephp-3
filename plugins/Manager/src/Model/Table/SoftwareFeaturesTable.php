<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SoftwareFeatures Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SoftwareCategories
 *
 * @method \Softmarket\Model\Entity\SoftwareFeature get($primaryKey, $options = [])
 * @method \Softmarket\Model\Entity\SoftwareFeature newEntity($data = null, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareFeature[] newEntities(array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareFeature|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Softmarket\Model\Entity\SoftwareFeature patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareFeature[] patchEntities($entities, array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwareFeature findOrCreate($search, callable $callback = null, $options = [])
 */
class SoftwareFeaturesTable extends Table
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

        $this->table('software_features');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('SoftwareCategories', [
            'foreignKey' => 'software_category_id',
            'joinType' => 'INNER',
            'className' => 'Softmarket.SoftwareCategories'
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
        $rules->add($rules->existsIn(['software_category_id'], 'SoftwareCategories'));

        return $rules;
    }
}
