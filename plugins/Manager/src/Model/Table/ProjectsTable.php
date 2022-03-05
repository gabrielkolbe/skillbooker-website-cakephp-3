<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 * @property \Cake\ORM\Association\HasMany $Bids
 * @property \Cake\ORM\Association\HasMany $Projectskills
 *
 * @method \Manager\Model\Entity\Project get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\Project findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectsTable extends Table
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

        $this->table('projects');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'joinType' => 'LEFT',
            'className' => 'Manager.Industries'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
            'className' => 'Manager.Users'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id',
            'className' => 'Manager.Currencies'
        ]);
        $this->hasMany('Bids', [
            'foreignKey' => 'project_id',
            'className' => 'Manager.Bids'
        ]);
        $this->hasMany('Projectskills', [
            'foreignKey' => 'project_id',
            'className' => 'Manager.Projectskills'
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
            ->notEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('awardeduser')
            ->allowEmpty('awardeduser');

        $validator
            ->integer('projecttype')
            ->allowEmpty('projecttype');

        $validator
            ->requirePresence('denomination', 'create')
            ->notEmpty('denomination');

        $validator
            ->requirePresence('currency_abbrev', 'create')
            ->notEmpty('currency_abbrev');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->allowEmpty('stage1');

        $validator
            ->requirePresence('stage2', 'create')
            ->notEmpty('stage2');

        $validator
            ->requirePresence('stage3', 'create')
            ->notEmpty('stage3');

        $validator
            ->requirePresence('stage4', 'create')
            ->notEmpty('stage4');

        $validator
            ->requirePresence('short_description', 'create')
            ->notEmpty('short_description');

        $validator
            ->integer('twittercount')
            ->allowEmpty('twittercount');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('bids')
            ->requirePresence('bids', 'create')
            ->notEmpty('bids');

        $validator
            ->requirePresence('skills', 'create')
            ->notEmpty('skills');

        $validator
            ->requirePresence('date_human', 'create')
            ->notEmpty('date_human');

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
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));

        return $rules;
    }
}
