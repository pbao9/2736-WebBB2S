<?php

namespace App\Enums\Contact;

use App\Admin\Support\Enum;

enum UserType: int
{
    use Enum;

    case parent = 0;
    case school = 1;

    public function badge(): string
    {
        return match($this) {
            UserType::parent => 'bg-cyan',
            UserType::school => 'bg-danger',
        };
    }
}
