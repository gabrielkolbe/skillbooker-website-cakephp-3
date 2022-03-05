<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $ParentQuestions
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\HasMany $QuestionComments
 * @property \Cake\ORM\Association\HasMany $QuestionSkills
 * @property \Cake\ORM\Association\HasMany $ChildQuestions
 *
 * @method \Manager\Model\Entity\Question get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\Question newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\Question[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\Question|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\Question[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\Question findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuestionsTable extends Table
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

        $this->table('questions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Manager.Users'
        ]);

        $this->hasMany('QuestionComments', [
            'foreignKey' => 'question_id',
            'className' => 'Manager.QuestionComments'
        ]);
        $this->hasMany('QuestionSkills', [
            'foreignKey' => 'question_id',
            'className' => 'Manager.QuestionSkills'
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
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('userslug', 'create')
            ->notEmpty('userslug');

        $validator
            ->integer('userreputation')
            ->allowEmpty('userreputation');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->integer('twittercount')
            ->allowEmpty('twittercount');

        $validator
            ->integer('hitcount')
            ->allowEmpty('hitcount');

        $validator
            ->allowEmpty('skills');

        $validator
            ->integer('votes')
            ->allowEmpty('votes');

        $validator
            ->integer('answers')
            ->allowEmpty('answers');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
