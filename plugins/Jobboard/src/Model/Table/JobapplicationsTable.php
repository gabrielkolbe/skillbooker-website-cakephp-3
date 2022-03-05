<?php
namespace Jobboard\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobapplications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Jobs
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Applicationstatuses
 *
 * @method \Jobboard\Model\Entity\Jobapplication get($primaryKey, $options = [])
 * @method \Jobboard\Model\Entity\Jobapplication newEntity($data = null, array $options = [])
 * @method \Jobboard\Model\Entity\Jobapplication[] newEntities(array $data, array $options = [])
 * @method \Jobboard\Model\Entity\Jobapplication|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Jobboard\Model\Entity\Jobapplication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Jobboard\Model\Entity\Jobapplication[] patchEntities($entities, array $data, array $options = [])
 * @method \Jobboard\Model\Entity\Jobapplication findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JobapplicationsTable extends Table
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

        $this->table('jobapplications');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Jobs', [
            'foreignKey' => 'job_id',
            'joinType' => 'INNER',
            'className' => 'Jobboard.Jobs'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Jobboard.Users'
        ]);
        $this->belongsTo('Applicationstatuses', [
            'foreignKey' => 'applicationstatus_id',
            'joinType' => 'INNER',
            'className' => 'Jobboard.Applicationstatuses'
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
        $rules->add($rules->existsIn(['job_id'], 'Jobs'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['applicationstatus_id'], 'Applicationstatuses'));

        return $rules;
    }
}
