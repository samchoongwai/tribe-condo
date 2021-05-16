<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VisitorLog Entity
 *
 * @property int $id
 * @property int $unit_id
 * @property string $full_name
 * @property string $contact
 * @property string $id_code
 * @property \Cake\I18n\FrozenTime $time_enter
 * @property \Cake\I18n\FrozenTime|null $time_exit
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\User $user
 */
class VisitorLog extends Entity
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
        'unit_id' => true,
        'full_name' => true,
        'contact' => true,
        'id_code' => true,
        'time_enter' => true,
        'time_exit' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'unit' => true,
        'user' => true,
    ];
}
