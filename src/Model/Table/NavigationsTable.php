<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Navigations Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Tabs
 *
 * @method \App\Model\Entity\Navigation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Navigation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Navigation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Navigation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Navigation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Navigation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Navigation findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NavigationsTable extends Table
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

        $this->table('navigations');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Tabs', [
            'foreignKey' => 'navigation_id',
            'targetForeignKey' => 'tab_id',
            'joinTable' => 'navigations_tabs'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        return $validator;
    }
}
