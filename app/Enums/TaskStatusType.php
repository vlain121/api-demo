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
}
