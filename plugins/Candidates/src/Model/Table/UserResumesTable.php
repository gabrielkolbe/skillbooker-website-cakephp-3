<?php
namespace Candidates\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserResumes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Candidates\Model\Entity\UserResume get($primaryKey, $options = [])
 * @method \Candidates\Model\Entity\UserResume newEntity($data = null, array $options = [])
 * @method \Candidates\Model\Entity\UserResume[] newEntities(array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserResume|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Candidates\Model\Entity\UserResume patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserResume[] patchEntities($entities, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserResume findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserResumesTable extends Table
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

        $this->table('user_resumes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Candidates.Users'
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
            ->integer('downloads')
            ->requirePresence('downloads', 'create')
            ->notEmpty('downloads');

        $validator
            ->requirePresence('resume', 'create')
            ->notEmpty('resume');

        $validator
            ->integer('is_searchable')
            ->requirePresence('is_searchable', 'create')
            ->notEmpty('is_searchable');

        $validator
            ->requirePresence('resume_content', 'create')
            ->notEmpty('resume_content');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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

        return $rules;
    }
}
