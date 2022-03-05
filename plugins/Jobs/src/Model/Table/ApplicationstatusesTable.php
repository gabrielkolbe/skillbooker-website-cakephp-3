<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applicationstatuses Model
 *
 * @property \Cake\ORM\Association\HasMany $Jobapplications
 *
 * @method \Jobs\Model\Entity\Applicationstatus get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Applicationstatus newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Applicationstatus[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Applicationstatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Applicationstatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Applicationstatus[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Applicationstatus findOrCreate($search, callable $callback = null, $options = [])
 */
class ApplicationstatusesTable extends Table
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

        $this->table('applicationstatuses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Jobapplications', [
            'foreignKey' => 'applicationstatus_id',
            'className' => 'Jobs.Jobapplications'
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
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
