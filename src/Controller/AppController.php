<?php

    declare(strict_types=1);

    /**
     * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
     * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
     *
     * Licensed under The MIT License
     * For full copyright and license information, please see the LICENSE.txt
     * Redistributions of files must retain the above copyright notice.
     *
     * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
     * @link      https://cakephp.org CakePHP(tm) Project
     * @since     0.2.9
     * @license   https://opensource.org/licenses/mit-license.php MIT License
     */

    namespace App\Controller;

    use Cake\Controller\Controller;
    use Cake\Core\Configure;

    /**
     * Application Controller
     *
     * Add your application-wide methods in the class below, your controllers
     * will inherit them.
     *
     * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
     */
    class AppController extends Controller
    {

        /**
         * Initialization hook method.
         *
         * Use this method to add common initialization code like loading components.
         *
         * e.g. `$this->loadComponent('FormProtection');`
         *
         * @return void
         */
        public function initialize(): void
        {
            parent::initialize();

            $this->loadComponent('RequestHandler');
            $this->loadComponent('Flash');

            /* <START> 20210513 SAM: Add Authentication */
            $this->loadComponent('Authentication.Authentication');
            /* <END> 20210513 SAM: Add Authentication */

            /*
             * Enable the following component for recommended CakePHP form protection settings.
             * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
             */
            //$this->loadComponent('FormProtection');
        }

        function beforeRender(\Cake\Event\EventInterface $event)
        {

            /* <START> 20210514 SAM: Get menu structure for private pages */
            $this->set('menu', Configure::read('menu'));
            /* <END> 20210514 SAM: Get menu structure for private pages */

            /* <START> 20210513 SAM: Pass authenticated user objeect to all controllers */
            $user = $this->Authentication->getIdentity();

            if ($user)
            {

                $this->loadModel('Users');
                $user = $this->Users->get($user['id'], [
                    'contain' => [
                        'Roles'
                    ]
                ]);

                $this->set('Auth', [
                    'id' => $user['id'],
                    'full_name' => $user['full_name'],
                    'contact' => $user['contact'],
                    'email' => $user['contact'],
                    'role_id' => $user['role_id'],
                    'role_code' => $user['role']['code']
                ]);
            }
            else
            {
                $this->set("Auth", []);
            }
            /* <END> 20210513 SAM: Pass authenticated user objeect to all controllers */
        }

    }
