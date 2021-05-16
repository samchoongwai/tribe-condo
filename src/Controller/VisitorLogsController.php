<?php

    declare(strict_types=1);

    namespace App\Controller;

    /**
     * VisitorLogs Controller
     *
     * @property \App\Model\Table\VisitorLogsTable $VisitorLogs
     * @method \App\Model\Entity\VisitorLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
     */
    class VisitorLogsController extends AppController
    {

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null|void Renders view
         */
        public function index()
        {
            /* default: retieve visitor logs for pass 10 years */
            $defaultDayFilter = 3650;

            /* if [d] parameter exists, override day filter */
            $queryString = $this->request->getQuery();
            $dayFilter = isset($queryString) && is_numeric($queryString) ? isset($queryString) : $defaultDayFilter;

            $visitorLogs = $this->VisitorLogs->find('all', [
                'contain' => [
                    'Units',
                    'Users'
                ],
                'conditions' => [
                    'DATE(VisitorLogs.time_enter) >= ' => date('Y-m-d', mktime(0, 0, 0, 0 + date('n'), date('d') - $dayFilter, 0 + date('Y')))
                ]
            ]);
            $this->set(compact('visitorLogs'));
        }

        /**
         * View method
         *
         * @param string|null $id Visitor Log id.
         * @return \Cake\Http\Response|null|void Renders view
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function view($id = null)
        {
            $visitorLog = $this->VisitorLogs->get($id, [
                'contain' => ['Units', 'Users'],
            ]);

            $this->set(compact('visitorLog'));
        }

        /**
         * Edit method
         *
         * @param string|null $id Visitor Log id.
         * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function edit($id = null)
        {
            $visitorLog = $this->VisitorLogs->get($id, [
                'contain' => ['Units', 'Users'],
            ]);
            if ($this->request->is(['patch', 'post', 'put']))
            {
                /* compose new time exit */
                $postData = $this->request->getData();

                if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $postData['new_time']))
                {
                    /* new time is in valid format hh:ii */
                    $postData['time_exit'] = date('Y-m-d', strtotime($postData['new_date'])) . 'T' . $postData['new_time'];

                    if ($postData['time_exit'] > $postData['time_enter'])
                    {
                        /* new time exit is not "earlier" than time enter */
                        $visitorLog = $this->VisitorLogs->patchEntity($visitorLog, $postData);
                        if ($this->VisitorLogs->save($visitorLog))
                        {
                            $this->Flash->success(__('The visitor log has been saved.'));

                            return $this->redirect(['action' => 'index']);
                        }
                        $this->Flash->error(__('The visitor log could not be saved. Please, try again.'));
                    }
                    else
                    {
                        /* new time exit is "earlier" than time enter */
                        $this->Flash->error(__('Time exit must be after time enter'));
                    }
                }
                else
                {
                    /* wrong time exit format */
                    $this->Flash->error(__('Please check the time format (hh:ii), eg: 16:45 = 4:45pm'));
                }
            }

            /* get "minDateAllowed" for date picker */
            $dateEnter = date_create(date('Y-m-d', strtotime($visitorLog->time_enter->format('Y-m-d H:i:s'))));
            $dateNow = date_create(date('Y-m-d'));
            $dateDiff = date_diff($dateEnter, $dateNow);
            $minDateAllowed = 0 - $dateDiff->days;

            $this->set(compact('visitorLog', 'minDateAllowed'));
        }

        /**
         * Delete method
         *
         * @param string|null $id Visitor Log id.
         * @return \Cake\Http\Response|null|void Redirects to index.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function delete($id = null)
        {
            $this->request->allowMethod(['post', 'delete']);
            $visitorLog = $this->VisitorLogs->get($id);
            if ($this->VisitorLogs->delete($visitorLog))
            {
                $this->Flash->success(__('The visitor log has been deleted.'));
            }
            else
            {
                $this->Flash->error(__('The visitor log could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }

        /* <START> 20210513 SAM: Registration */

        /**
         * registration method
         *
         * @return \Cake\Http\Response|null|void Redirects to index.
         */
        public function registration()
        {
            $visitorLog = $this->VisitorLogs->newEmptyEntity();
            if ($this->request->is('post'))
            {
                $postData = $this->request->getData();

                /* check for redundant check in */
                $openVisitorLog = $this->VisitorLogs->find('all', [
                            'conditions' => [
                                'time_exit IS NULL',
                                'contact' => $postData['contact'],
                                'id_code' => $postData['id_code']
                            ]
                        ])->all();

                if ($openVisitorLog->count() > 0)
                {
                    $this->Flash->error(__('Visitor has checked in.'));
                }
                else
                {
                    $visitorLog = $this->VisitorLogs->patchEntity($visitorLog, $this->request->getData());
                    if ($this->VisitorLogs->save($visitorLog))
                    {
                        $this->Flash->success(__('The visitor log has been saved.'));

                        return $this->redirect(['action' => 'registration']);
                    }
                    $this->Flash->error(__('The visitor log could not be saved. Please, try again.'));
                }
            }


            /* get units list */
            $this->loadModel('Units');

            $units = $this->Units->find('all', [
                        'contain' => ['UnitTypes'],
                        'order' => [
                            'block' => 'asc',
                            'unit_number' => 'asc'
                        ]
                    ])->all();

            $unitList = [];
            $blockList = [];

            if ($units)
            {
                foreach ($units as $unit)
                {
                    $blockList[$unit['block']] = $unit['block'];
                    $unitList[] = [
                        'id' => $unit['id'],
                        'block' => $unit['block'],
                        'unit_number' => $unit['unit_number'],
                        'occupant' => $unit['occupant'],
                        'contact' => $unit['contact'],
                        'capacity' => $unit['unit_type']['capacity']
                    ];
                }
            }



            $this->paginate = [
                'contain' => ['Units', 'Units.UnitTypes'],
            ];
            $visitorLogs = $this->paginate($this->VisitorLogs);

            $this->set(compact(['visitorLogs', 'unitList', 'blockList']));
        }

        /* <END> 20210513 SAM: Registration */

        /* <START> 20210514 SAM: visitor log page */

        /**
         * Delete method
         *
         * @param string|null $contact visitor contact/ string|null $id visitor last 3 digits id number
         * @return \Cake\Http\Response|null|void
         */
        public function visitor($contact = null, $id = null)
        {
            $visitorLogs = $this->VisitorLogs->find('all', [
                'contain' => [
                    'Units'
                ],
                'conditions' => [
                    'VisitorLogs.contact' => $contact,
                    'VisitorLogs.id_code' => $id,
                    'DATE(VisitorLogs.time_enter) >= ' => date('Y-m-d', mktime(0, 0, 0, 0 + date('n'), date('d') - 30, 0 + date('Y')))
                ]
            ]);
            $this->set(compact('visitorLogs'));
        }

        /* <END> 20210514 SAM: visitor log page */


        /* <START> 20210515 SAM: Visitor list */

        public function visitorList()
        {
            /* retrieve all unique visitors records */
            $visitorList = $this->VisitorLogs->find();
            $visitorList->select(
                            [
                                'contact',
                                'id_code' => 'id_code',
                                'count' => $visitorList->func()->count('time_enter'),
                                'latest_visit' => $visitorList->func()->max('time_enter', ['datetime'])
                            ]
                    )
                    ->group([
                        'contact', 'id_code'
                    ])->all();

            $this->set(compact('visitorList'));
        }

        /* <END> 20210515 SAM: Visitor list */
    }
