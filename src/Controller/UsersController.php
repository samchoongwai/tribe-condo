<?php

    declare(strict_types=1);

    namespace App\Controller;

    /**
     * Users Controller
     *
     * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
     */
    class UsersController extends AppController
    {
        /* <START> 20210513 SAM: Skip authentication check for public pages */

        public function beforeFilter(\Cake\Event\EventInterface $event)
        {
            parent::beforeFilter($event);
            $this->Authentication->addUnauthenticatedActions(['login']);
        }

        /* <END> 20210513 SAM: Skip authentication check for public pages */

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null|void Renders view
         */
        public function index()
        {
            $users = $this->paginate($this->Users, [
                'contain' => [
                    'Roles'
                ]
            ]);
            $this->set(compact('users'));
        }

        /**
         * View method
         *
         * @param string|null $id User id.
         * @return \Cake\Http\Response|null|void Renders view
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function view($id = null)
        {
            $user = $this->Users->get($id, [
                'contain' => [
                    'Roles'
                ],
            ]);

            $this->set(compact('user'));
        }

        /**
         * Add method
         *
         * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
         */
        public function add()
        {
            $user = $this->Users->newEmptyEntity();
            if ($this->request->is('post'))
            {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user))
                {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            $roles = $this->Users->Roles->find('list', ['limit' => 200]);
            $this->set(compact(['user', 'roles']));
        }

        /**
         * Edit method
         *
         * @param string|null $id User id.
         * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function edit($id = null)
        {
            $user = $this->Users->get($id, [
                'contain' => [],
            ]);
            if ($this->request->is(['patch', 'post', 'put']))
            {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user))
                {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            $roles = $this->Users->Roles->find('list')->where('status = 1')->all();
            $this->set(compact('user', 'roles'));
        }

        /**
         * Delete method
         *
         * @param string|null $id User id.
         * @return \Cake\Http\Response|null|void Redirects to index.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function delete($id = null)
        {
            $this->request->allowMethod(['post', 'delete']);
            $user = $this->Users->get($id);
            if ($this->Users->delete($user))
            {
                $this->Flash->success(__('The user has been deleted.'));
            }
            else
            {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }

        /* <START> 20210513 SAM: login funtion */

        /**
         * login method
         *
         * @return rediretion
         */
        public function login()
        {
            $this->request->allowMethod(['get', 'post']);
            $result = $this->Authentication->getResult();
            // regardless of POST or GET, redirect if user is logged in
            if ($result->isValid())
            {
                if ($result->getData()->status != 1)
                {
                    $redirect = $this->request->getQuery('redirect', [
                        'controller' => 'Users',
                        'action' => 'logout',
                    ]);
                    $this->Flash->error(__('Invalid username or password'));
                }
                else
                {
                    $user = $this->Users->get($result->getData()->id, [
                        'contain' => [
                            'Roles'
                        ]
                    ]);

                    if ($user['role']['code'] == 'ADM')
                    {
                        $redirect = $this->request->getQuery('redirect', [
                            'controller' => 'Dashboard',
                            'action' => 'index',
                        ]);
                    }
                    else
                    {
                        $redirect = $this->request->getQuery('redirect', [
                            'controller' => 'Visitor-logs',
                            'action' => 'registration',
                        ]);
                    }
                }
                return $this->redirect($redirect);
            }

            if ($this->request->is('post') && !$result->isValid())
            {
                $this->Flash->error(__('Invalid username or password'));
            }
        }

        /* <END> 20210513 SAM: login funtion */


        /* <START> 20210513 SAM: logout funtion */

        /**
         * login method
         *
         * @return rediretion ==> Login page
         */
        public function logout()
        {
            $result = $this->Authentication->getResult();
            if ($result->isValid())
            {
                $this->Authentication->logout();
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
        }

        /* <END> 20210513 SAM: logout funtion */
    }
