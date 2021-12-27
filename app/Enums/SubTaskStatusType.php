<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static INCOMPLETE()
 * @method static static DONE()
 */
final class SubTaskStatusType extends Enum
{
    const INCOMPLETE = 0;
    const DONE = 1;
}
