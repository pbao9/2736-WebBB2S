<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Published()
 * @method static static Draft()
 */
final class NotificationType extends Enum implements LocalizedEnum
{
    const All = 1;
    const Driver = 2;
    const Parent = 3;
    const Nany = 4;
}
