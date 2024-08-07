<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';
    protected $guarded = [];


    public function district()
    {
        return $this->hasMany(District::class, 'province_code', 'code');
    }
}
