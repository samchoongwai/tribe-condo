<?php

    declare(strict_types=1);

    namespace App\Controller;

    /**
     * Dashboard Controller
     *
     *
     */
    class DashboardController extends AppController
    {

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null|void Renders view
         */
        public function index()
        {
            $this->loadModel('VisitorLogs');

            /* <START> 20210515 SAM: Retrieve total number of visits by day (14 days) */
            $visitorLogs = $this->VisitorLogs->find();
            $visitorLogs->select(
                            [
                                'count' => $visitorLogs->func()->count('date(time_enter)'),
                                'date' => 'DATE(time_enter)'
                            ]
                    )
                    ->where([
                        'DATE(VisitorLogs.time_enter) >= ' => date('Y-m-d', mktime(0, 0, 0, 0 + date('n'), date('d') - 14, 0 + date('Y')))
                    ])
                    ->group('date');

            /* do not return large payload, arrange data into [ "date" => "number" ] array */
            $visitByDay = [];
            foreach ($visitorLogs->all() as $item)
            {
                $visitByDay[$item->date] = $item['count'];
            }
            /* <END> 20210515 SAM: Retrieve total number of visits by day (14 days) */


            /* <START> 20210515 SAM: Retrieve top 5 most visited units (14 days) */
            $mostVisitedUnit = $this->VisitorLogs->find();
            $mostVisitedUnit->select(
                            [
                                'count' => $visitorLogs->func()->count('date(time_enter)'),
                                'unit_id' => 'unit_id',
                                'block' => 'Units.block',
                                'unit_number' => 'Units.unit_number'
                            ]
                    )
                    ->contain([
                        'Units'
                    ])
                    ->where([
                        'DATE(VisitorLogs.time_enter) >= ' => date('Y-m-d', mktime(0, 0, 0, 0 + date('n'), date('d') - 14, 0 + date('Y')))
                    ])
                    ->group('unit_id')
                    ->order(['count' => 'desc'])
                    ->limit(5);
            /* <END> 20210515 SAM: Retrieve top 5 most visited units (14 days) */

            $this->set(compact('visitByDay', 'mostVisitedUnit'));
        }

    }
