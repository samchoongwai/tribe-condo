<?php

    declare(strict_types=1);

    namespace App\Controller;

    /**
     * Api Controller
     *
     * To provide API services for Registration page
     */
    class ApiController extends AppController
    {
        /* <START> 20210513 SAM: Skip authentication check for public pages */

        public function beforeFilter(\Cake\Event\EventInterface $event)
        {
            parent::beforeFilter($event);
            // $this->Authentication->addUnauthenticatedActions(['unitStatus', 'getCheckIns']);
        }

        /* <END> 20210513 SAM: Skip authentication check for public pages */



        /* <START> 20210514 SAM: return current status of an unit */

        /**
         * unitStatus method
         *
         * @param string|null $id Unit id.
         * @return JSON.
         *  JSON {
         *      "block": Block
         *      "unit_number": Unit number
         *      "occupant":Occupant name
         *      "contact": Occupant contact
         *      "visitor_logs": current visits (not checkout)
         *      "unit_type": Unit type object
         *      "availability": Available visit quota (0 = visit not allowed)
         *  }
         */
        public function unitStatus($id = null)
        {
            $this->loadModel('Units');

            $unit = $this->Units->get($id, [
                'contain' => [
                    'UnitTypes',
                    'VisitorLogs' => [
                        'conditions' => [
                            'time_exit IS NULL'
                        ]
                    ]
                ]
            ]);

            /* calculate availability (0 = no more visitor allowed) => unit capacity - current visitors */
            $unit->availability = max(0, $unit['unit_type']['capacity'] - count($unit['visitor_logs']));

            $this->set([
                'data' => $unit
            ]);
            $this->viewBuilder()->setLayout('json');
        }

        /* <END> 20210514 SAM: load available capacity of an unit */


        /* <START> 20210514 SAM: return current visits */

        /**
         * getCheckIns method
         *
         * @return headless HTML page with current visitor log in grid form
         */
        public function getCheckIns()
        {
            $this->loadModel('VisitorLogs');

            $visitorLogs = $this->VisitorLogs->find('all', [
                        'contain' => [
                            'Units'
                        ],
                        'conditions' => [
                            'time_exit IS NULL'
                        ]
                    ])->all();
            $this->set(compact('visitorLogs'));
            $this->viewBuilder()->setLayout('headless');
        }

        /* <END> 20210514 SAM: load current visits */


        /* <START> 20210514 SAM: return current visits */
        /*
          Parameters:
          $id = visitor log ID to checkout

          Return:
          JSON {
          code: 200 = success / 500 = fail
          title: Status description
          }
         */

        /**
         * checkout method
         *
         * @param string|null $id Unit id.
         * @return JSON.
         *  JSON {
         *      code: 200 = success / 500 = fail
         *      title: Status description
         *  }
         */
        public function checkout($id = null)
        {
            $this->loadModel('VisitorLogs');

            $visitorLog = $this->VisitorLogs->get($id);
            /* Auto fill in check out date time */
            if ($visitorLog->time_exit == '')
            {
                $visitorLog->time_exit = date('Y-m-d H:i');
            }

            $json = [
                'code' => 500,
                'title' => 'Checkout failed'
            ];

            if ($this->VisitorLogs->save($visitorLog))
            {
                $json = [
                    'code' => 200,
                    'title' => 'Checkout succeed'
                ];
            }
            $this->set([
                'data' => $json
            ]);
            $this->viewBuilder()->setLayout('json');
        }

        /* <END> 20210514 SAM: load current visits */
    }
