<?php
namespace App\Repositories\Product;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Product\ProductRepository as AdminProductRepository;
use App\Models\Product;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class ProductRepository extends AdminProductRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }
}