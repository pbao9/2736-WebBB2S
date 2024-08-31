<?php

namespace App\Enums\Student;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class StudentGrade extends Enum implements LocalizedEnum
{
    const Grade1 = 1;
    const Grade2 = 2;
    const Grade3 = 3;
    const Grade4 = 4;
    const Grade5 = 5;
    const Grade6 = 6;
    const Grade7 = 7;
    const Grade8 = 8;
    const Grade9 = 9;
    const Seed = 10;

    public function badge(): string
    {
        return match ($this->value) {
            self::Grade1 => 'bg-green',
            self::Grade2 => 'bg-green',
            self::Grade3 => 'bg-yellow',
            self::Grade4 => 'bg-yellow',
            self::Grade5 => 'bg-red',
            self::Grade6 => 'bg-red',
            self::Grade7 => 'bg-orange',
            self::Grade8 => 'bg-orange',
            self::Grade9 => 'bg-brown',
            self::Seed => 'bg-brown',
            default => 'bg-default',
        };
    }
}
