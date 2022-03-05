<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Timesheets Model
 *
 * @method \App\Model\Entity\Timesheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timesheet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Timesheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timesheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TimesheetsTable extends Table
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

        $this->table('timesheets');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TimesheetProcesses', [
            'foreignKey' => 'timesheet_process_id',
            'joinType' => 'LEFT'
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
            ->integer('employer')
            ->requirePresence('employer', 'create')
            ->notEmpty('employer');

        $validator
            ->integer('agent')
            ->requirePresence('agent', 'create')
            ->notEmpty('agent');


        $validator
            ->requirePresence('currentmonth', 'create')
            ->notEmpty('currentmonth');
            
        $validator
            ->requirePresence('days', 'create')
            ->notEmpty('days');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
