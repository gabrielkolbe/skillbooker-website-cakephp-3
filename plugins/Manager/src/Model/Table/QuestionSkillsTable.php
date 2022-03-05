<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionSkills Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Questions
 * @property \Cake\ORM\Association\BelongsTo $Skills
 * @property \Cake\ORM\Association\BelongsTo $Industries
 *
 * @method \Qanda\Model\Entity\QuestionSkill get($primaryKey, $options = [])
 * @method \Qanda\Model\Entity\QuestionSkill newEntity($data = null, array $options = [])
 * @method \Qanda\Model\Entity\QuestionSkill[] newEntities(array $data, array $options = [])
 * @method \Qanda\Model\Entity\QuestionSkill|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Qanda\Model\Entity\QuestionSkill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Qanda\Model\Entity\QuestionSkill[] patchEntities($entities, array $data, array $options = [])
 * @method \Qanda\Model\Entity\QuestionSkill findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuestionSkillsTable extends Table
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

        $this->table('question_skills');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER',
            'className' => 'Qanda.Questions'
        ]);
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
            'className' => 'Qanda.Skills'
        ]);
        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'joinType' => 'INNER',
            'className' => 'Qanda.Industries'
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
            ->requirePresence('skill_name', 'create')
            ->notEmpty('skill_name');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

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
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['skill_id'], 'Skills'));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));

        return $rules;
    }
}
