<?php

namespace App\Enums\Contract;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class ContractStatus extends Enum implements LocalizedEnum
{
    const Active = 1;
    const Stopped = 2;
    const Draft = 3;
    const Ready = 4;

    public function badge(): string
    {
        return match ($this->value) {
            self::Active => 'bg-green',
            self::Stopped => 'bg-red',
            self::Draft => 'bg-yellow',
            default => 'bg-default',
        };
    }
}
