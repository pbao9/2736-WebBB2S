<?php

namespace App\Models;

use App\Enums\Contract\ContractStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';
    protected $fillable = [
        /** school_id */
        'school_id',
        /** driver_id */
        'driver_id',
        /** nany_id */
        'nany_id',
        /** Buổi đưa học sinh tới trường */
        'session_arrive_school',
        /** Thời gian học sinh tới trường */
        'time_arrive_school',
        /** Buổi đón học sinh */
        'session_off',
        /** Thời gian đón học sinh */
        'time_off',
        /** Lịch đón học sinh */
        'schedule',
        /** Thời gian hợp tạo hợp đồng */
        'created_at',
        /** Thời gian hợp đồng hết hạn */
        'expired_at',
        /** Thời gian hợp đồng hết hạn cũ */
        'old_expired_at',
        /** Loại dịch vụ của hợp đồng (Chỉ đón đi, Chỉ đón về, Cả hai) */
        'type',
        /** Trạng thái hợp đồng */
        'status',
    ];
    protected $casts = [
        'status' => ContractStatus::class,
    ];

    public function nany(): BelongsTo
    {
        return $this->belongsTo(Nany::class, 'nany_id');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(ContractDetail::class, 'contract_id')->orderBy('id', 'desc');
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class, 'contract_id');
    }

    public function scheduleOff(): HasMany
    {
        return $this->hasMany(ScheduleOff::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'contract_details', 'contract_id', 'student_id');
    }

}
