<?php

namespace App\Enums\Session;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Morning()
 * @method static static Afternoon()
 */
final class Session extends Enum implements LocalizedEnum
{
    const Morning = 1;
    const Afternoon = 2;

}
