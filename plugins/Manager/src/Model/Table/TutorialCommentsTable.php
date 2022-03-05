<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TutorialComments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentTutorialComments
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Tutorials
 * @property \Cake\ORM\Association\HasMany $ChildTutorialComments
 *
 * @method \Manager\Model\Entity\TutorialComment get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\TutorialComment newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\TutorialComment[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialComment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\TutorialComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialComment[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialComment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TutorialCommentsTable extends Table
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

        $this->table('tutorial_comments');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentTutorialComments', [
            'className' => 'Manager.TutorialComments',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Manager.Users'
        ]);
        $this->belongsTo('Tutorials', [
            'foreignKey' => 'tutorial_id',
            'joinType' => 'INNER',
            'className' => 'Manager.Tutorials'
        ]);
        $this->hasMany('ChildTutorialComments', [
            'className' => 'Manager.TutorialComments',
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
            ->integer('is_parent')
            ->requirePresence('is_parent', 'create')
            ->notEmpty('is_parent');

        $validator
            ->integer('is_child')
            ->allowEmpty('is_child');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->integer('approved')
            ->requirePresence('approved', 'create')
            ->notEmpty('approved');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('userslug', 'create')
            ->notEmpty('userslug');

        $validator
            ->requirePresence('useravatar', 'create')
            ->notEmpty('useravatar');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentTutorialComments'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['tutorial_id'], 'Tutorials'));

        return $rules;
    }
}
