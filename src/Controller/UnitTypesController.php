<?php

    declare(strict_types=1);

    namespace App\Controller;

    /**
     * UnitTypes Controller
     *
     * @property \App\Model\Table\UnitTypesTable $UnitTypes
     * @method \App\Model\Entity\UnitType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
     */
    class UnitTypesController extends AppController
    {

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null|void Renders view
         */
        public function index()
        {
            $unitTypes = $this->paginate($this->UnitTypes);
            $this->set(compact('unitTypes'));
        }

        /**
         * View method
         *
         * @param string|null $id Unit Type id.
         * @return \Cake\Http\Response|null|void Renders view
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function view($id = null)
        {
            $unitType = $this->UnitTypes->get($id, [
                'contain' => ['Units' => [
                        'conditions' => [
                            'status' => 1
                        ]
                    ]],
            ]);

            $this->set(compact('unitType'));
        }

        /**
         * Add method
         *
         * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
         */
        public function add()
        {
            $unitType = $this->UnitTypes->newEmptyEntity();
            if ($this->request->is('post'))
            {
                $unitType = $this->UnitTypes->patchEntity($unitType, $this->request->getData());
                if ($this->UnitTypes->save($unitType))
                {
                    $this->Flash->success(__('The unit type has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The unit type could not be saved. Please, try again.'));
            }
            $this->set(compact('unitType'));
        }

        /**
         * Edit method
         *
         * @param string|null $id Unit Type id.
         * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function edit($id = null)
        {
            $unitType = $this->UnitTypes->get($id, [
                'contain' => [],
            ]);
            if ($this->request->is(['patch', 'post', 'put']))
            {
                $unitType = $this->UnitTypes->patchEntity($unitType, $this->request->getData());
                if ($this->UnitTypes->save($unitType))
                {
                    $this->Flash->success(__('The unit type has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The unit type could not be saved. Please, try again.'));
            }
            $this->set(compact('unitType'));
        }

    }
