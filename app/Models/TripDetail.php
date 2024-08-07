<?php

namespace App\Models;

use App\Enums\Session\Session;
use App\Enums\Trip\PickupStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class TripDetail extends Model
{
    use HasFactory;

    protected $table = 'trip_details';

    public $timestamps = false;

    protected $fillable = [
        /** ID Chuyến đi */
        'trip_id',
        /** ID học sinh */
        'student_id',
        /** Trạng thái đón */
        'picked_up',
        /** Hình ảnh học sinh lúc lên xe khi đi */
        'pickup_image_start',
        /** Hình ảnh học sinh lúc lên xe khi về */
        'pickup_image_end',
        /** Ảnh học sinh */
        'student_image',
        /** Thời gian đi */
        'check_in',
        /** Thời gian về */
        'check_out',
        /** Lý do bỏ qua học sinh */
        'skip_reason'

    ];

    protected $casts = [
        'picked_up' => PickupStatus::class,
    ];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function getPickupAddressAttribute()
    {
        return optional($this->trip->contract->detail->firstWhere('student_id', $this->student_id))->pick_address;
    }

    /** Lấy thông tin thời gian Đón theo học sinh */
    public function getPickupTimeAttribute(): ?string
    {
        $contractDetail = $this->trip->contract->detail->firstWhere('student_id', $this->student_id);
        if ($contractDetail) {
            if ($this->trip->session->value === Session::Afternoon) {
                return Carbon::parse($this->trip->contract->time_off)->format('g:i A');
            } else {
                return Carbon::parse($contractDetail->time_pick)->format('g:i A');
            }
        }
        return null;
    }

    /** Lấy thông tin thời gian về theo học sinh */
    public function getPickupOffTimeAttribute(): ?string
    {
        $contractDetail = $this->trip->contract->detail->firstWhere('student_id', $this->student_id);
        if ($contractDetail) {
            return Carbon::parse($contractDetail->time_arrive_home)->format('g:i A');
        }
        return null;
    }


}
