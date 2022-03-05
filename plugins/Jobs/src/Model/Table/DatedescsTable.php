<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Datedescs Model
 *
 * @property \Cake\ORM\Association\HasMany $Jobs
 *
 * @method \Jobs\Model\Entity\Datedesc get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Datedesc newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Datedesc[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Datedesc|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Datedesc patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Datedesc[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Datedesc findOrCreate($search, callable $callback = null, $options = [])
 */
class DatedescsTable extends Table
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

        $this->table('datedescs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Jobs', [
            'foreignKey' => 'datedesc_id',
            'className' => 'Jobs.Jobs'
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
