<?php
namespace Candidates\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserArticles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $UserArticleCategories
 * @property \Cake\ORM\Association\BelongsToMany $Images
 *
 * @method \Candidates\Model\Entity\UserArticle get($primaryKey, $options = [])
 * @method \Candidates\Model\Entity\UserArticle newEntity($data = null, array $options = [])
 * @method \Candidates\Model\Entity\UserArticle[] newEntities(array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserArticle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Candidates\Model\Entity\UserArticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserArticle[] patchEntities($entities, array $data, array $options = [])
 * @method \Candidates\Model\Entity\UserArticle findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserArticlesTable extends Table
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

        $this->table('user_articles');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Candidates.Users'
        ]);
        $this->belongsTo('UserArticleCategories', [
            'foreignKey' => 'user_article_category_id',
            'joinType' => 'INNER',
            'className' => 'Candidates.UserArticleCategories'
        ]);
        $this->belongsToMany('Images', [
            'foreignKey' => 'user_article_id',
            'targetForeignKey' => 'image_id',
            'joinTable' => 'user_articles_images',
            'className' => 'Candidates.Images'
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
            ->requirePresence('content', 'create')
            ->notEmpty('content');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['user_article_category_id'], 'UserArticleCategories'));

        return $rules;
    }
}
