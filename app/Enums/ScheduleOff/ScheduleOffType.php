<?php

namespace App\Enums\ScheduleOff;


use App\Admin\Support\Enum;

enum ScheduleOffType: int
{
    use Enum;

    // Chung
    case Public = 1;

    // Riêng
    case Private = 2;

    //Không phân loại
    case Normal = 3;


    public function badge(): string
    {
        return match ($this) {
            self::Public => 'bg-green',
            self::Private => 'bg-orange',
            self::Normal => 'bg-blue',
        };
    }
}
