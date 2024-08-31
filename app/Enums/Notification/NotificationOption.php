<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Published()
 * @method static static Draft()
 */
final class NotificationOption extends Enum implements LocalizedEnum
{
    const All = 1;
    const One = 2;
}
