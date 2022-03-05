<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TimesheetProcesses Model
 *
 * @property \Cake\ORM\Association\HasMany $Timesheets
 *
 * @method \Manager\Model\Entity\TimesheetProcess get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\TimesheetProcess newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\TimesheetProcess[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\TimesheetProcess|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\TimesheetProcess patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\TimesheetProcess[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\TimesheetProcess findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TimesheetProcessesTable extends Table
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

        $this->table('timesheet_processes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Timesheets', [
            'foreignKey' => 'timesheet_process_id',
            'className' => 'Manager.Timesheets'
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

        return $validator;
    }
}
