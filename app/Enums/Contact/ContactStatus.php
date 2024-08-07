<?php

namespace App\Enums\Contact;

use App\Admin\Support\Enum;

enum ContactStatus: int
{
    use Enum;

    case notContacted = 0;
    case contacted = 1;

    public function badge(): string
    {
        return match($this) {
            ContactStatus::contacted => 'bg-green',
            ContactStatus::notContacted => 'bg-danger',
        };
    }
}
