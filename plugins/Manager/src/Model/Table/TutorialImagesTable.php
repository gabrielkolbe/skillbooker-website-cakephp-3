<?php
namespace Manager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TutorialImages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tutorials
 *
 * @method \Manager\Model\Entity\TutorialImage get($primaryKey, $options = [])
 * @method \Manager\Model\Entity\TutorialImage newEntity($data = null, array $options = [])
 * @method \Manager\Model\Entity\TutorialImage[] newEntities(array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialImage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Manager\Model\Entity\TutorialImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialImage[] patchEntities($entities, array $data, array $options = [])
 * @method \Manager\Model\Entity\TutorialImage findOrCreate($search, callable $callback = null, $options = [])
 */
class TutorialImagesTable extends Table
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

        $this->table('tutorial_images');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Tutorials', [
            'foreignKey' => 'tutorial_id',
            'joinType' => 'INNER',
            'className' => 'Manager.Tutorials'
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
            ->requirePresence('location', 'create')
            ->notEmpty('location');

        $validator
            ->requirePresence('photo', 'create')
            ->notEmpty('photo');

        $validator
            ->requirePresence('alttag', 'create')
            ->notEmpty('alttag');

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
        $rules->add($rules->existsIn(['tutorial_id'], 'Tutorials'));

        return $rules;
    }
}
