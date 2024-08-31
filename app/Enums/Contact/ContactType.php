<?php

namespace App\Enums\Contact;

use App\Admin\Support\Enum;

enum ContactType: int
{
    use Enum;

    case findCar = 0;
    case forParent = 1;
    case forSchool = 2;

    public function badge(): string
    {
        return match($this) {
            ContactType::findCar => 'bg-green',
            ContactType::forParent => 'bg-warning',
            ContactType::forSchool => 'bg-cyan',
        };
    }
}
