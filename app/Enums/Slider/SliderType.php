<?php

namespace App\Enums\Slider;


use App\Admin\Support\Enum;

enum SliderType: int
{
    use Enum;

    case Staff = 1;

    case Parent = 2;

    public function badge(): string
    {
        return match ($this) {
            SliderType::Staff => 'bg-green-lt',
            SliderType::Parent => 'bg-red-lt',
        };
    }
}
