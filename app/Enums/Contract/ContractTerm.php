<?php

namespace App\Enums\Contract;


use App\Admin\Support\Enum;

enum ContractTerm: int
{
    use Enum;
    case Valid = 1;
    case Expired = 2;
}
