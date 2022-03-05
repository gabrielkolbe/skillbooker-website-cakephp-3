<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailLogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EmailTemplates
 *
 * @method \Manager\Model\Entity\EmailLog get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\EmailLog newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\EmailLog[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\EmailLog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\EmailLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\EmailLog[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\EmailLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailLogsTable extends Table
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

        $this->table('email_logs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EmailTemplates', [
            'foreignKey' => 'email_template_id',
            'joinType' => 'INNER',
            'className' => 'Manager.EmailTemplates'
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
            ->integer('receiver')
            ->requirePresence('receiver', 'create')
            ->notEmpty('receiver');

        $validator
            ->requirePresence('receiver_email', 'create')
            ->notEmpty('receiver_email');

        $validator
            ->integer('sender')
            ->requirePresence('sender', 'create')
            ->notEmpty('sender');

        $validator
            ->requirePresence('sender_email', 'create')
            ->notEmpty('sender_email');

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
        $rules->add($rules->existsIn(['email_template_id'], 'EmailTemplates'));

        return $rules;
    }
}
