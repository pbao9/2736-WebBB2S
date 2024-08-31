<?php

namespace App\Enums\Driver;


use App\Admin\Support\Enum;

enum DriverStatus: int
{
    use Enum;

    // Đang hoạt động
    case Active = 1;

    // Không hoạt động
    case OnBreak = 2;

    public function badge(): string
    {
        return match ($this) {
            self::Active => 'bg-green',
            self::OnBreak => 'bg-orange',
        };
    }
}
