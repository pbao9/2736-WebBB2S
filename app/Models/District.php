<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $guarded = [];

    public function wards()
    {
        return $this->hasMany(Ward::class, 'district_code', 'code');
    }


    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }

    public function school(){
        return $this->belongsTo(School::class, 'code', 'district_code');
    }
}
