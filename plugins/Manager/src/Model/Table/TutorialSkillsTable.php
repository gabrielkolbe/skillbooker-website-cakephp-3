<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TutorialSkills Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tutorials
 * @property \Cake\ORM\Association\BelongsTo $Skills
 *
 * @method \Manager\Model\Entity\TutorialSkill get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\TutorialSkill newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\TutorialSkill[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialSkill|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\TutorialSkill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialSkill[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialSkill findOrCreate($search, callable $callback = null, $options = [])
 */
class TutorialSkillsTable extends Table
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

        $this->table('tutorial_skills');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Tutorials', [
            'foreignKey' => 'tutorial_id',
            'joinType' => 'INNER',
            'className' => 'Manager.Tutorials'
        ]);
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
            'className' => 'Manager.Skills'
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
        $rules->add($rules->existsIn(['tutorial_id'], 'Tutorials'));
        $rules->add($rules->existsIn(['skill_id'], 'Skills'));

        return $rules;
    }
}
