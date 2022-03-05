<?php
namespace Candidates\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserRatings Model
 *
 * @method \Candidates\Model\Entity\UserRating get($primaryKey, $options = [])
 * @method \Candidates\Model\Entity\UserRating newEntity($data = null, array $options = [])
 * @method \Candidates\Model\Entity\UserRating[] newEntities(array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserRating|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Candidates\Model\Entity\UserRating patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserRating[] patchEntities($entities, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserRating findOrCreate($search, callable $callback = null, $options = [])
 */
class UserRatingsTable extends Table
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

        $this->table('user_ratings');
        $this->displayField('name');
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('stars')
            ->requirePresence('stars', 'create')
            ->notEmpty('stars');

        return $validator;
    }
}
