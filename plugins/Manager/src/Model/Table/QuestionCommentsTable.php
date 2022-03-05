<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionComments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Questions
 * @property \Cake\ORM\Association\BelongsTo $ParentQuestionComments
 * @property \Cake\ORM\Association\HasMany $ChildQuestionComments
 *
 * @method \Qanda\Model\Entity\QuestionComment get($primaryKey, $options = [])
 * @method \Qanda\Model\Entity\QuestionComment newEntity($data = null, array $options = [])
 * @method \Qanda\Model\Entity\QuestionComment[] newEntities(array $data, array $options = [])
 * @method \Qanda\Model\Entity\QuestionComment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Qanda\Model\Entity\QuestionComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Qanda\Model\Entity\QuestionComment[] patchEntities($entities, array $data, array $options = [])
 * @method \Qanda\Model\Entity\QuestionComment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuestionCommentsTable extends Table
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

        $this->table('question_comments');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Qanda.Users'
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER',
            'className' => 'Qanda.Questions'
        ]);
        $this->belongsTo('ParentQuestionComments', [
            'className' => 'Qanda.QuestionComments',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildQuestionComments', [
            'className' => 'Qanda.QuestionComments',
            'foreignKey' => 'parent_id'
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
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('userslug', 'create')
            ->notEmpty('userslug');

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
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentQuestionComments'));

        return $rules;
    }
}
