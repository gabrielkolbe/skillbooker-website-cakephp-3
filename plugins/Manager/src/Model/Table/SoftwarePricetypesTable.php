<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SoftwarePricetypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Softwares
 *
 * @method \Softmarket\Model\Entity\SoftwarePricetype get($primaryKey, $options = [])
 * @method \Softmarket\Model\Entity\SoftwarePricetype newEntity($data = null, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwarePricetype[] newEntities(array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwarePricetype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Softmarket\Model\Entity\SoftwarePricetype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwarePricetype[] patchEntities($entities, array $data, array $options = [])
 * @method \Softmarket\Model\Entity\SoftwarePricetype findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SoftwarePricetypesTable extends Table
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

        $this->table('software_pricetypes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Softwares', [
            'foreignKey' => 'software_pricetype_id',
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

        return $validator;
    }
}
