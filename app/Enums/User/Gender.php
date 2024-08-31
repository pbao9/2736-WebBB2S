<?php

namespace App\Enums\User;


use App\Supports\Enum;

enum Gender: int
{
    use Enum;

    case Male = 1;
    case Female = 2;
    case Other = 3;

    public function badge(): string
    {
        return match ($this) {
            Gender::Male => 'bg-green',
            Gender::Female => 'bg-pink',
            Gender::Other => 'bg-blue',
        };
    }
}

