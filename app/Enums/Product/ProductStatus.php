<?php
namespace App\Enums\Product;

use App\Admin\Support\Enum;

enum ProductStatus: int
{
    use Enum;

    case Published = 1;
    case Draft = 2;

    public function badge(): string
    {
        return match ($this) {
            ProductStatus::Published => 'bg-green',
            ProductStatus::Draft => 'bg-red',
        };
    }
}
