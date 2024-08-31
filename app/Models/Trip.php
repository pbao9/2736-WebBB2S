<?php

namespace App\Models;

use App\Enums\Contract\ContractType;
use App\Enums\Session\Session;
use App\Enums\Trip\TripStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trips';

    protected $fillable = [
        /** ID Hợp đồng */
        'contract_id',
        /** driver_id */
        'driver_id',
        /** nany_id */
        'nany_id',
        /** Ngày của chuyến đi */
        'trip_date',
        /** Ngày trong tuần của chuyến đi */
        'day_of_week',
        /** Mô tả về chuyến đi */
        'description',
        /** Trạng thái của chuyến đi */
        'status',
        /** Mã chuyến đi */
        'code',
        /** Buổi (Sáng/ Chiều) */
        'session',
        /** Buổi Đón/Về */
        'type',
        /** Hình ảnh chụp chung */
        'destination_photo',
        /** Thời gian khởi hành */
        'check_in',
        /** Thời gian kết thúc */
        'check_out',
        /** Thời gian tới trường */
        'time_arrived_at_school',
        /** Địa chỉ hiện tại */
        'current_address',
        /** Vĩ độ của địa chỉ hiện tại */
        'current_lat',
        /** Kinh độ của địa chỉ hiện tại */
        'current_lng',

    ];

    protected $casts = [
        'status' => TripStatus::class,
        'session' => Session::class,
        'type' => ContractType::class
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'trip_details', 'trip_id', 'student_id');
    }

    public function tripDetails(): HasMany
    {
        return $this->hasMany(TripDetail::class, 'trip_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function nany(): BelongsTo
    {
        return $this->belongsTo(Nany::class, 'nany_id');
    }

    public function school(): BelongsTo
    {
        return $this->contract->school();
    }
}
