<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TutorialCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $TutorialComments
 * @property \Cake\ORM\Association\HasMany $Tutorials
 *
 * @method \Tutorials\Model\Entity\TutorialCategory get($primaryKey, $options = [])
 * @method \Tutorials\Model\Entity\TutorialCategory newEntity($data = null, array $options = [])
 * @method \Tutorials\Model\Entity\TutorialCategory[] newEntities(array $data, array $options = [])
 * @method \Tutorials\Model\Entity\TutorialCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Tutorials\Model\Entity\TutorialCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Tutorials\Model\Entity\TutorialCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \Tutorials\Model\Entity\TutorialCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class TutorialCategoriesTable extends Table
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

        $this->table('tutorial_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('TutorialComments', [
            'foreignKey' => 'tutorial_category_id',
            'className' => 'Tutorials.TutorialComments'
        ]);
        $this->hasMany('Tutorials', [
            'foreignKey' => 'tutorial_category_id',
            'className' => 'Tutorials.Tutorials'
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
            ->integer('tutorial_count')
            ->requirePresence('tutorial_count', 'create')
            ->notEmpty('tutorial_count');

        $validator
            ->integer('rank')
            ->requirePresence('rank', 'create')
            ->notEmpty('rank');

        return $validator;
    }
}
