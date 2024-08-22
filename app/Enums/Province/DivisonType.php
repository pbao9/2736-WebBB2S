<?php

namespace App\Enums\Province;

use App\Admin\Support\Enum;

enum DivisonType: string
{
    use Enum;

    //Tỉnh
    case province = 'tỉnh';
    //Thành phố trung ương
    case central_city = 'thành phố trung ương';


    public function badge(): string
    {
        return match ($this) {
            DivisonType::province => 'bg-success',
            DivisonType::central_city => 'bg-cyan',
            default => 'bg-default',
        };
    }
}
