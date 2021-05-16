<?php

    declare(strict_types=1);

    namespace App\Controller;

    /**
     * Units Controller
     *
     */
    class UnitsController extends AppController
    {

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null|void Renders view
         */
        public function index()
        {
            /* filter by status = 1 ==> active unit, status = 0 ==> "deleted unit" */
            $this->paginate = [
                'contain' => ['UnitTypes'],
                'conditions' => [
                    'status' => 1
                ]
            ];
            $units = $this->paginate($this->Units);

            $this->set(compact('units'));
        }

        /**
         * View method
         *
         * @param string|null $id Unit id.
         * @return \Cake\Http\Response|null|void Renders view
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function view($id = null)
        {
            /* associated visitor log: limit to pass 30 days only  */
            $unit = $this->Units->get($id, [
                'contain' => ['UnitTypes', 'VisitorLogs' => [
                        'conditions' => [
                            'date(time_enter) >= ' => date('Y-m-d', mktime(0, 0, 0, 0 + date('n'), date('d') - 30, 0 + date('Y')))
                        ]
                    ]
                ],
            ]);
            $this->set(compact('unit'));
        }

        /**
         * Add method
         *
         * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
         */
        public function add()
        {
            $unit = $this->Units->newEmptyEntity();
            if ($this->request->is('post'))
            {
                $unit = $this->Units->patchEntity($unit, $this->request->getData());
                if ($this->Units->save($unit))
                {
                    $this->Flash->success(__('The unit has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The unit could not be saved. Please, try again.'));
            }
            $unitTypes = $this->Units->UnitTypes->find('list', ['limit' => 200]);
            $this->set(compact('unit', 'unitTypes'));
        }

        /**
         * Edit method
         *
         * @param string|null $id Unit id.
         * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function edit($id = null)
        {
            $unit = $this->Units->get($id, [
                'contain' => [],
            ]);
            if ($this->request->is(['patch', 'post', 'put']))
            {
                $unit = $this->Units->patchEntity($unit, $this->request->getData());
                if ($this->Units->save($unit))
                {
                    $this->Flash->success(__('The unit has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The unit could not be saved. Please, try again.'));
            }
            $unitTypes = $this->Units->UnitTypes->find('list', ['limit' => 200]);
            $this->set(compact('unit', 'unitTypes'));
        }

        /**
         * Delete method
         *
         * @param string|null $id Unit id.
         * @return \Cake\Http\Response|null|void Redirects to index.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function delete($id = null)
        {
            $this->request->allowMethod(['post', 'delete']);

            /* Do not delete record: foreign key restriction (associated with VisitorLogs) */
            $unit = $this->Units->get($id);
            $unit->status = 0;

            if ($this->Units->save($unit))
            {
                $this->Flash->success(__('The unit has been deleted.'));
            }
            else
            {
                $this->Flash->error(__('The unit could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }

    }
