<?php
namespace Jobs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contactmethods Model
 *
 * @property \Cake\ORM\Association\HasMany $Candidates
 * @property \Cake\ORM\Association\HasMany $Companies
 *
 * @method \Jobs\Model\Entity\Contactmethod get($primaryKey, $options = [])
 * @method \Jobs\Model\Entity\Contactmethod newEntity($data = null, array $options = [])
 * @method \Jobs\Model\Entity\Contactmethod[] newEntities(array $data, array $options = [])
 * @method \Jobs\Model\Entity\Contactmethod|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobs\Model\Entity\Contactmethod patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Contactmethod[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobs\Model\Entity\Contactmethod findOrCreate($search, callable $callback = null, $options = [])
 */
class ContactmethodsTable extends Table
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

        $this->table('contactmethods');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Candidates', [
            'foreignKey' => 'contactmethod_id',
            'className' => 'Jobs.Candidates'
        ]);
        $this->hasMany('Companies', [
            'foreignKey' => 'contactmethod_id',
            'className' => 'Jobs.Companies'
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
