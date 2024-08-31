<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        /** avatar */
        'avatar',
        /** Tên phụ huynh  */
        'fullname',
        /** Số điện thoại phụ huynh */
        'phone',
        /** Tên phụ huynh khác */
        'name_other',
        /** SDT phụ huynh khác */
        'phone_other',
        /** Ghi chú */
        'note',
        /** Lớp */
        'grade',
        /** Chi tiết lớp */
        'grade_detail',
    ];
    protected $casts = [
    ];

    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(MenusParent::class, 'parent_students', 'student_id', 'parent_id');
    }

    public function scheduleOff(): HasMany
    {
        return $this->hasMany(ScheduleOff::class);
    }

    public function contract(): HasOneThrough
    {
        return $this->hasOneThrough(Contract::class, ContractDetail::class, 'student_id', 'id', 'id', 'contract_id');
    }

    public function trips(): BelongsToMany
    {
        return $this->belongsToMany(Trip::class, 'trip_details', 'student_id', 'trip_id');
    }

    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class, 'school_student', 'student_id', 'school_id');
    }
}
