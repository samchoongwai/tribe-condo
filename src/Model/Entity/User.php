<?php

    declare(strict_types=1);

    namespace App\Model\Entity;

    use Cake\ORM\Entity;
    use Cake\Auth\DefaultPasswordHasher;

    /**
     * User Entity
     *
     * @property int $id
     * @property string $full_name
     * @property string $contact
     * @property string|null $email
     * @property string $username
     * @property string $password
     * @property int $role_id
     * @property \Cake\I18n\FrozenTime|null $created
     * @property \Cake\I18n\FrozenTime|null $modified
     * @property int $status
     *
     * @property \App\Model\Entity\Role $role
     * @property \App\Model\Entity\VisitorLog[] $visitor_logs
     */
    class User extends Entity
    {

        /**
         * Fields that can be mass assigned using newEntity() or patchEntity().
         *
         * Note that when '*' is set to true, this allows all unspecified fields to
         * be mass assigned. For security purposes, it is advised to set '*' to false
         * (or remove it), and explicitly make individual fields accessible as needed.
         *
         * @var array
         */
        protected $_accessible = [
            'full_name' => true,
            'contact' => true,
            'email' => true,
            'username' => true,
            'password' => true,
            'role_id' => true,
            'created' => true,
            'modified' => true,
            'status' => true,
            'role' => true,
            'visitor_logs' => true,
        ];

        /**
         * Fields that are excluded from JSON versions of the entity.
         *
         * @var array
         */
        protected $_hidden = [
            'password',
        ];

        /* <START> 20210513 SAM: Add pasword hasher */

        protected function _setPassword(string $password): ?string
        {
            if (strlen($password) > 0)
            {
                return (new DefaultPasswordHasher())->hash($password);
            }
        }

        /* <END> 20210513 SAM: Add pasword hasher */
    }
