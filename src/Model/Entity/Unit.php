<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Unit Entity
 *
 * @property int $id
 * @property string $block
 * @property string $unit_number
 * @property string $occupant
 * @property string $contact
 * @property int $unit_type_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\UnitType $unit_type
 * @property \App\Model\Entity\VisitorLog[] $visitor_logs
 */
class Unit extends Entity
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
        'block' => true,
        'unit_number' => true,
        'occupant' => true,
        'contact' => true,
        'unit_type_id' => true,
        'created' => true,
        'modified' => true,
        'unit_type' => true,
        'visitor_logs' => true,
    ];
}
