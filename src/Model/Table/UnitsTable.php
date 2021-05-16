<?php

    declare(strict_types=1);

    namespace App\Model\Table;

    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;

    /**
     * Units Model
     *
     * @property \App\Model\Table\UnitTypesTable&\Cake\ORM\Association\BelongsTo $UnitTypes
     * @property \App\Model\Table\VisitorLogsTable&\Cake\ORM\Association\HasMany $VisitorLogs
     *
     * @method \App\Model\Entity\Unit newEmptyEntity()
     * @method \App\Model\Entity\Unit newEntity(array $data, array $options = [])
     * @method \App\Model\Entity\Unit[] newEntities(array $data, array $options = [])
     * @method \App\Model\Entity\Unit get($primaryKey, $options = [])
     * @method \App\Model\Entity\Unit findOrCreate($search, ?callable $callback = null, $options = [])
     * @method \App\Model\Entity\Unit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
     * @method \App\Model\Entity\Unit[] patchEntities(iterable $entities, array $data, array $options = [])
     * @method \App\Model\Entity\Unit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
     * @method \App\Model\Entity\Unit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
     * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
     * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
     * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
     * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
     *
     * @mixin \Cake\ORM\Behavior\TimestampBehavior
     */
    class UnitsTable extends Table
    {

        /**
         * Initialize method
         *
         * @param array $config The configuration for the Table.
         * @return void
         */
        public function initialize(array $config): void
        {
            parent::initialize($config);

            $this->setTable('units');
            $this->setDisplayField('id');
            $this->setPrimaryKey('id');

            $this->addBehavior('Timestamp');

            $this->belongsTo('UnitTypes', [
                'foreignKey' => 'unit_type_id',
                'joinType' => 'INNER',
            ]);
            $this->hasMany('VisitorLogs', [
                'foreignKey' => 'unit_id',
            ]);
        }

        /**
         * Default validation rules.
         *
         * @param \Cake\Validation\Validator $validator Validator instance.
         * @return \Cake\Validation\Validator
         */
        public function validationDefault(Validator $validator): Validator
        {
            $validator
                    ->integer('id')
                    ->allowEmptyString('id', null, 'create');

            $validator
                    ->scalar('block')
                    ->maxLength('block', 20)
                    ->requirePresence('block', 'create')
                    ->notEmptyString('block');

            $validator
                    ->scalar('unit_number')
                    ->maxLength('unit_number', 20)
                    ->requirePresence('unit_number', 'create')
                    ->notEmptyString('unit_number');

            $validator
                    ->scalar('occupant')
                    ->maxLength('occupant', 255)
                    ->requirePresence('occupant', 'create')
                    ->notEmptyString('occupant');

            $validator
                    ->scalar('contact')
                    ->maxLength('contact', 20)
                    ->requirePresence('contact', 'create')
                    ->notEmptyString('contact');

            return $validator;
        }

        /**
         * Returns a rules checker object that will be used for validating
         * application integrity.
         *
         * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
         * @return \Cake\ORM\RulesChecker
         */
        public function buildRules(RulesChecker $rules): RulesChecker
        {
            $rules->add($rules->isUnique(['block', 'unit_number']), ['errorField' => 'unit_number']);
            $rules->add($rules->existsIn(['unit_type_id'], 'UnitTypes'), ['errorField' => 'unit_type_id']);

            return $rules;
        }

    }
