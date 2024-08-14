<?php

namespace App\Models;

use App\Admin\Support\Eloquent\Sluggable;
use App\Enums\Product\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'products';

    protected $guarded = [];

    protected $columnSlug = 'title';
    
    protected $casts = [
        'status' => ProductStatus::class,
    ];

    public function isPublished(): bool
    {
        return $this->status == ProductStatus::Published;
    }

    public function scopePublished($query)
    {
        return $query->where('status', ProductStatus::Published);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id');
    }
}
