<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static LOW()
 * @method static static MEDIUM()
 * @method static static HIGH()
 * @method static static URGENT()
 */
final class TaskPrioType extends Enum
{
    const LOW = 0;
    const MEDIUM = 1;
    const HIGH = 2;
    const URGENT = 3;

    public static function getLabel($value)
    {
        $result = '';
        switch ($value) {
            case self::LOW:
                $result = 'Low';
                break;
            case self::MEDIUM:
                $result = 'Medium';
                break;
            case self::HIGH:
                $result = 'High';
                break;
            case self::URGENT:
                $result = 'Urgent';
                break;
        }
        return $result;
    }
}
