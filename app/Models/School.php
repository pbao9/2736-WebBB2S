<?php

namespace App\Models;

use App\Enums\DefaultStatus;
use App\Enums\School\SchoolStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    protected $fillable = [
        'name',
        'province_code',
        'district_code',
        'status'
    ];

    protected $casts = [
        'status' => SchoolStatus::class,
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'school_student', 'school_id', 'student_id');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }
}
