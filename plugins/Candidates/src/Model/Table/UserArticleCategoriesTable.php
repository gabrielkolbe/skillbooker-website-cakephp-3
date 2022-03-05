<?php
namespace Candidates\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserArticleCategories Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $UserArticles
 *
 * @method \Candidates\Model\Entity\UserArticleCategory get($primaryKey, $options = [])
 * @method \Candidates\Model\Entity\UserArticleCategory newEntity($data = null, array $options = [])
 * @method \Candidates\Model\Entity\UserArticleCategory[] newEntities(array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserArticleCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Candidates\Model\Entity\UserArticleCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserArticleCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserArticleCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class UserArticleCategoriesTable extends Table
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

        $this->table('user_article_categories');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Candidates.Users'
        ]);
        $this->hasMany('UserArticles', [
            'foreignKey' => 'user_article_category_id',
            'className' => 'Candidates.UserArticles'
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
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->integer('tutorial_count')
            ->requirePresence('tutorial_count', 'create')
            ->notEmpty('tutorial_count');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        $validator
            ->integer('catorder')
            ->requirePresence('catorder', 'create')
            ->notEmpty('catorder');

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
