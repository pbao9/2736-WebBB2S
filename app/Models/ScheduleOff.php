<?php

namespace App\Models;

use App\Enums\DefaultStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleOff extends Model
{
    use HasFactory;

    protected $table = 'schedule_off';
    protected $fillable = [
        /** student_id */
        'student_id',
        /** nany_id */
        'nany_id',
        /** contract_id */
        'contract_id',
        /** driver_id */
        'driver_id',
        /** Ngày xin nghỉ */
        'date_off',
        /** Loại ngày nghỉ */
        'type',
        /** Ghi chú lý do xin nghỉ */
        'note',
        /** Trạng thái */
        'status'
    ];
    protected $casts = [
        'note' => 'string',
        'status' => DefaultStatus::class
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function nany(): BelongsTo
    {
        return $this->belongsTo(Nany::class, 'nany_id');
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }


}
