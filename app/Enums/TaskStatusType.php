<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static FRESH()
 * @method static static PENDING()
 * @method static static CANCELED()
 * @method static static DONE()
 */
final class TaskStatusType extends Enum
{
    const FRESH = 0;
    const PENDING = 1;
    const CANCELED = 2;
    const DONE = 3;

    public static function getLabel($value)
    {
        $result = '';
        switch ($value) {
            case self::FRESH:
                $result = 'New';
                break;
            case self::PENDING:
                $result = 'Pending';
                break;
            case self::CANCELED:
                $result = 'Canceled';
                break;
            case self::DONE:
                $result = 'Done';
                break;
        }
        return $result;
    }
}
