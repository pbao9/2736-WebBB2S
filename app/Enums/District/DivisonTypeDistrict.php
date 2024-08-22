<?php

namespace App\Enums\District;

use App\Admin\Support\Enum;

enum DivisonTypeDistrict: string
{
    use Enum;

    case districts = 'quận';
    case county  = 'huyện';
    case town  = 'thị xã';
    case city = 'thành phố';


    public function badge(): string
    {
        return match ($this) {
            DivisonTypeDistrict::districts => 'bg-success',
            DivisonTypeDistrict::county => 'bg-cyan',
            DivisonTypeDistrict::town => 'bg-yellow',
            DivisonTypeDistrict::city => 'bg-primary',
            default => 'bg-default',
        };
    }
}
