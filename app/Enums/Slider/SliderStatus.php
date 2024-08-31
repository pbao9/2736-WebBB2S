<?php

namespace App\Enums\Slider;


use App\Admin\Support\Enum;

enum SliderStatus: int
{
    use Enum;

    case Active = 1;

    case InActive = 2;

    public function badge(): string
    {
        return match ($this) {
            SliderStatus::Active => 'bg-green-lt',
            SliderStatus::InActive => 'bg-red-lt',
        };
    }
}
