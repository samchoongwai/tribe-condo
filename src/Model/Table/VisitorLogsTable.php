<?php

    declare(strict_types=1);

    namespace App\Model\Table;

    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;

    /**
     * VisitorLogs Model
     *
     * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsTo $Units
     * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
     *
     * @method \App\Model\Entity\VisitorLog newEmptyEntity()
     * @method \App\Model\Entity\VisitorLog newEntity(array $data, array $options = [])
     * @method \App\Model\Entity\VisitorLog[] newEntities(array $data, array $options = [])
     * @method \App\Model\Entity\VisitorLog get($primaryKey, $options = [])
     * @method \App\Model\Entity\VisitorLog findOrCreate($search, ?callable $callback = null, $options = [])
     * @method \App\Model\Entity\VisitorLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
     * @method \App\Model\Entity\VisitorLog[] patchEntities(iterable $entities, array $data, array $options = [])
     * @method \App\Model\Entity\VisitorLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
     * @method \App\Model\Entity\VisitorLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
     * @method \App\Model\Entity\VisitorLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
     * @method \App\Model\Entity\VisitorLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
     * @method \App\Model\Entity\VisitorLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
     * @method \App\Model\Entity\VisitorLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
     *
     * @mixin \Cake\ORM\Behavior\TimestampBehavior
     */
    class VisitorLogsTable extends Table
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

            $this->setTable('visitor_logs');
            $this->setDisplayField('id');
            $this->setPrimaryKey('id');

            $this->addBehavior('Timestamp');

            $this->belongsTo('Units', [
                'foreignKey' => 'unit_id',
                'joinType' => 'INNER',
            ]);
            $this->belongsTo('Users', [
                'foreignKey' => 'user_id',
                'joinType' => 'INNER',
            ]);
        }

        /* <START> 20210514 SAM: Auto fill in check in time */

        public function beforeSave($event, $entity, $options)
        {
            /* NEW RECORD */
            if (!$entity->id)
            {
                $entity->time_enter = date('Y-m-d H:i:s');
            }
        }

        /* <END> 20210514 SAM: Auto fill in check in time */

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
                    ->scalar('full_name')
                    ->maxLength('full_name', 255)
                    ->requirePresence('full_name', 'create')
                    ->notEmptyString('full_name');

            $validator
                    ->scalar('contact')
                    ->maxLength('contact', 20)
                    ->requirePresence('contact', 'create')
                    ->notEmptyString('contact');

            $validator
                    ->scalar('id_code')
                    ->maxLength('id_code', 20)
                    ->requirePresence('id_code', 'create')
                    ->notEmptyString('id_code');

            $validator
                    ->dateTime('time_enter')
                    ->allowEmptyDateTime('time_enter');
            // ->notEmptyDateTime('time_enter');

            $validator
                    ->dateTime('time_exit')
                    ->allowEmptyDateTime('time_exit');

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
            $rules->add($rules->existsIn(['unit_id'], 'Units'), ['errorField' => 'unit_id']);
            $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

            return $rules;
        }

    }
