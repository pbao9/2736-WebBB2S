<?php

namespace App\Enums;

use App\Admin\Support\Enum;

enum DefaultStatus: int
{
    use Enum;

    // Hoạt động
    case Active = 1;

    case Deleted = 2;


    public function badge(): string
    {
        return match ($this) {
            DefaultStatus::Active => 'bg-yellow',
            DefaultStatus::Deleted => 'bg-red',
            default => 'bg-default',
        };
    }
}
