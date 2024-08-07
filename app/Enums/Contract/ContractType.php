<?php

namespace App\Enums\Contract;


use App\Admin\Support\Enum;

enum ContractType: int
{
    use Enum;

    case Both = 1;
    case PickUpOnly = 2;
    case DropOffOnly = 3;

    public function label(): string
    {
        return match ($this) {
            ContractType::PickUpOnly => __('Chỉ đón đi'),
            ContractType::DropOffOnly => __('Chỉ đón về'),
            ContractType::Both => __('Cả hai'),
        };
    }
}
