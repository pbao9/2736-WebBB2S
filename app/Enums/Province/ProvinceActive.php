<?php

namespace App\Enums\Province;

use App\Admin\Support\Enum;

enum ProvinceActive: int
{
    use Enum;

    //Không Hoạt động
    case InActive = 0;
    // Hoạt động
    case Active = 1;


    public function badge(): string
    {
        return match ($this) {
            ProvinceActive::Active => 'bg-success',
            ProvinceActive::InActive => 'bg-danger',
            default => 'bg-default',
        };
    }
}
