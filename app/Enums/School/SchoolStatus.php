<?php

namespace App\Enums\School;

use App\Admin\Support\Enum;

enum SchoolStatus: int
{
    use Enum;

    // Hoạt động
    case Active = 1;
    //Không Hoạt động
    case InActive = 2;


    public function badge(): string
    {
        return match ($this) {
            SchoolStatus::Active => 'bg-yellow',
            SchoolStatus::InActive => 'bg-red',
            default => 'bg-default',
        };
    }
}
