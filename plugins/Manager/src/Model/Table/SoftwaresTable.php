<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Softwares Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 * @property \Cake\ORM\Association\BelongsTo $SoftwarePricetypes
 * @property \Cake\ORM\Association\BelongsTo $SoftwareCategories
 *
 * @method \Soft\Model\Entity\Software get($primaryKey, $options = [])
 * @method \Soft\Model\Entity\Software newEntity($data = null, array $options = [])
 * @method \Soft\Model\Entity\Software[] newEntities(array $data, array $options = [])
 * @method \Soft\Model\Entity\Software|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Soft\Model\Entity\Software patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Soft\Model\Entity\Software[] patchEntities($entities, array $data, array $options = [])
 * @method \Soft\Model\Entity\Software findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SoftwaresTable extends Table
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

        $this->table('softwares');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Soft.Users'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id',
            'joinType' => 'INNER',
            'className' => 'Soft.Currencies'
        ]);
        $this->belongsTo('SoftwarePricetypes', [
            'foreignKey' => 'software_pricetype_id',
            'joinType' => 'INNER',
            'className' => 'Soft.SoftwarePricetypes'
        ]);
        $this->belongsTo('SoftwareCategories', [
            'foreignKey' => 'software_category_id',
            'joinType' => 'INNER',
            'className' => 'Soft.SoftwareCategories'
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
            ->requirePresence('software_category_id', 'create')
            ->notEmpty('software_category_id');
            
          $validator
            ->requirePresence('currency_id', 'create')
            ->notEmpty('currency_id');
                                                 
        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');
        
        $validator
            ->requirePresence('pricedisplay', 'create')
            ->notEmpty('pricedisplay');  
            
        $validator
            ->requirePresence('software_pricetype_id', 'create')
            ->notEmpty('software_pricetype_id');
            
        $validator
            ->integer('priceperuser')
            ->requirePresence('priceperuser', 'create')
            ->notEmpty('priceperuser');  
            
        $validator
            ->integer('demoavailable')
            ->requirePresence('demoavailable', 'create')
            ->notEmpty('demoavailable');

        $validator
            ->integer('freeversion')
            ->requirePresence('freeversion', 'create')
            ->notEmpty('freeversion');

        $validator
            ->integer('freetrail')
            ->requirePresence('freetrail', 'create')
            ->notEmpty('freetrail');
            
            
        $validator
            ->requirePresence('software_deployment_ids', 'create')
            ->notEmpty('software_deployment_ids');
            
            
        $validator
            ->requirePresence('software_support_ids', 'create')
            ->notEmpty('software_support_ids');
            
     /*       
        $validator
            ->requirePresence('software_demo_ids', 'create')
            ->notEmpty('software_demo_ids');
    */
            
        $validator
            ->requirePresence('software_training_ids', 'create')
            ->notEmpty('software_training_ids');
            
        $validator
            ->requirePresence('software_feature_ids', 'create')
            ->notEmpty('software_feature_ids');

        $validator
            ->requirePresence('short_description', 'create')
            ->notEmpty('short_description');
            

        $validator
            ->requirePresence('long_description', 'create')
            ->notEmpty('long_description');

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
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));
        $rules->add($rules->existsIn(['software_pricetype_id'], 'SoftwarePricetypes'));
        $rules->add($rules->existsIn(['software_category_id'], 'SoftwareCategories'));

        return $rules;
    }
}
