<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 * @property \Cake\ORM\Association\HasMany $States
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \Basic\Model\Entity\Country get($primaryKey, $options = [])
 * @method \Basic\Model\Entity\Country newEntity($data = null, array $options = [])
 * @method \Basic\Model\Entity\Country[] newEntities(array $data, array $options = [])
 * @method \Basic\Model\Entity\Country|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Basic\Model\Entity\Country patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Basic\Model\Entity\Country[] patchEntities($entities, array $data, array $options = [])
 * @method \Basic\Model\Entity\Country findOrCreate($search, callable $callback = null)
 */
class CountriesTable extends Table
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

        $this->table('countries');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('States', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'country_id'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('iso_alpha2');

        $validator
            ->allowEmpty('iso_alpha3');

        $validator
            ->integer('iso_numeric')
            ->allowEmpty('iso_numeric');

        $validator
            ->allowEmpty('country_currency');

        $validator
            ->allowEmpty('currency_name');

        $validator
            ->allowEmpty('currency_symbol');

        $validator
            ->requirePresence('html_entity', 'create')
            ->notEmpty('html_entity');

        $validator
            ->allowEmpty('flag');

        $validator
            ->integer('jobcount')
            ->requirePresence('jobcount', 'create')
            ->notEmpty('jobcount');

        $validator
            ->integer('displayme')
            ->requirePresence('displayme', 'create')
            ->notEmpty('displayme');

        return $validator;
    }
}
