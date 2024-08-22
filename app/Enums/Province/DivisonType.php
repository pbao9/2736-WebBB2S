<?php

namespace App\Enums\Province;

use App\Admin\Support\Enum;

enum DivisonType: int
{
    use Enum;

    //Tỉnh
    case province = 0;
    //Thành phố trung ương
    case central_city = 1;


    public function badge(): string
    {
        return match ($this) {
            DivisonType::province => 'bg-success',
            DivisonType::central_city => 'bg-cyan',
            default => 'bg-default',
        };
    }
}
