<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailLayouts Model
 *
 * @method \Eventbooker\Model\Entity\EmailLayout get($primaryKey, $options = [])
 * @method \Eventbooker\Model\Entity\EmailLayout newEntity($data = null, array $options = [])
 * @method \Eventbooker\Model\Entity\EmailLayout[] newEntities(array $data, array $options = [])
 * @method \Eventbooker\Model\Entity\EmailLayout|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Eventbooker\Model\Entity\EmailLayout patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Eventbooker\Model\Entity\EmailLayout[] patchEntities($entities, array $data, array $options = [])
 * @method \Eventbooker\Model\Entity\EmailLayout findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailLayoutsTable extends Table
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

        $this->table('email_layouts');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('EmailTemplates', [
            'foreignKey' => 'layout_id'
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
            ->requirePresence('layout', 'create')
            ->notEmpty('layout');

        return $validator;
    }
}
