<?php
namespace Candidates\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $CandidateStatuses
 * @property \Cake\ORM\Association\BelongsTo $CandidateRatings
 * @property \Cake\ORM\Association\BelongsTo $CandidateSources
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Jobtypes
 * @property \Cake\ORM\Association\BelongsTo $Contactmethods
 *
 * @method \Candidates\Model\Entity\Candidate get($primaryKey, $options = [])
 * @method \Candidates\Model\Entity\Candidate newEntity($data = null, array $options = [])
 * @method \Candidates\Model\Entity\Candidate[] newEntities(array $data, array $options = [])
 * @method \Candidates\Model\Entity\Candidate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Candidates\Model\Entity\Candidate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Candidates\Model\Entity\Candidate[] patchEntities($entities, array $data, array $options = [])
 * @method \Candidates\Model\Entity\Candidate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CandidatesTable extends Table
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

        $this->table('candidates');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Candidates.Users'
        ]);
        $this->belongsTo('CandidateStatuses', [
            'foreignKey' => 'candidate_status_id',
            'joinType' => 'INNER',
            'className' => 'Candidates.CandidateStatuses'
        ]);
        $this->belongsTo('CandidateRatings', [
            'foreignKey' => 'candidate_rating_id',
            'className' => 'Candidates.CandidateRatings'
        ]);
        $this->belongsTo('CandidateSources', [
            'foreignKey' => 'candidate_source_id',
            'className' => 'Candidates.CandidateSources'
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'className' => 'Candidates.Companies'
        ]);
        $this->belongsTo('Jobtypes', [
            'foreignKey' => 'jobtype_id',
            'className' => 'Candidates.Jobtypes'
        ]);
        $this->belongsTo('Contactmethods', [
            'foreignKey' => 'contactmethod_id',
            'className' => 'Candidates.Contactmethods'
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

        return $rules;
    }
}
