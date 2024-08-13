<?php

namespace App\Models;

use App\Enums\Slider\SliderStatus;
use App\Enums\Slider\SliderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slider extends Model
{
    use HasFactory;
    
    const CACHE_KEY_GET_ALL = 'cache_sliders';

    protected $table = 'sliders';

    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(SliderItem::class, 'slider_id')->orderBy('position', 'asc');
    }

    protected $casts = [
        'status' => SliderStatus::class,
        'type' => SliderType::class,
    ];

    public function scopeActive($query): void
    {
        $query->where('status', SliderStatus::Active);
    }
}
