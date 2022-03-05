<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tutorials Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TutorialCategories
 * @property \Cake\ORM\Association\HasMany $TutorialComments
 * @property \Cake\ORM\Association\HasMany $TutorialImages
 * @property \Cake\ORM\Association\HasMany $TutorialSkills
 *
 * @method \Manager\Model\Entity\Tutorial get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\Tutorial newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\Tutorial[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\Tutorial|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\Tutorial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\Tutorial[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\Tutorial findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class TutorialsTable extends Table
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

        $this->table('tutorials');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', ['TutorialCategories' => ['tutorial_count']]);

        $this->belongsTo('TutorialCategories', [
            'foreignKey' => 'tutorial_category_id',
            'joinType' => 'INNER',
            'className' => 'Manager.TutorialCategories'
        ]);
        $this->hasMany('TutorialComments', [
            'foreignKey' => 'tutorial_id',
            'className' => 'Manager.TutorialComments'
        ]);
        $this->hasMany('TutorialImages', [
            'foreignKey' => 'tutorial_id',
            'className' => 'Manager.TutorialImages'
        ]);
        $this->hasMany('TutorialSkills', [
            'foreignKey' => 'tutorial_id',
            'className' => 'Manager.TutorialSkills'
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
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('short', 'create')
            ->notEmpty('short');


        $validator
            ->requirePresence('source', 'create')
            ->notEmpty('source');

        $validator
            ->integer('twittercount')
            ->requirePresence('twittercount', 'create')
            ->notEmpty('twittercount');

        $validator
            ->integer('hitcount')
            ->requirePresence('hitcount', 'create')
            ->notEmpty('hitcount');

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
        $rules->add($rules->existsIn(['tutorial_category_id'], 'TutorialCategories'));

        return $rules;
    }
}
