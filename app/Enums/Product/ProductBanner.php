<?php
namespace App\Enums\Product;

use App\Admin\Support\Enum;

enum ProductBanner: int
{
    use Enum;

    case Off = 0;
    case On = 1;

    public function badge(): string
    {
        return match ($this) {
            ProductBanner::On => 'bg-green',
            ProductBanner::Off => 'bg-red',
        };
    }
}
