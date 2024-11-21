<?php

namespace App\Models;

use App\Admin\Support\Eloquent\Sluggable;
use App\Enums\Province\ProvinceActive;
use App\Models\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'provinces';

    // Loại bỏ lưu cột created_at & update_at
    public $timestamps = false;
    protected $fillable = [
        'code',
        'name',
        'division_type',
        'phone_code',
        'active'
    ];

    protected $columnSlug = 'name';


    public function district()
    {
        return $this->hasMany(District::class, 'province_code', 'code')
            ->orderBy('name', 'desc');
    }


    public function scopeActive($query)
    {
        return $query->where('active', ProvinceActive::Active);
    }
}
