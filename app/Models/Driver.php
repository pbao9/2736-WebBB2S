<?php

namespace App\Models;

use App\Admin\Traits\Roles;
use App\Enums\DefaultStatus;
use App\Enums\Driver\DriverStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Roles;

    protected $table = 'drivers';
    protected $fillable = [
        /** user id */
        'user_id',
        /** avatar */
        'avatar',
        /** CCCD */
        'id_card',
        /** Ngày cấp CCCD */
        'id_card_date',
        /** Ảnh CCCD mặt trước */
        'id_card_front',
        /** Ảnh CCCD mặt sau */
        'id_card_back',
        /** Biển số xe */
        'license_plate',
        /** Hãng xe */
        'vehicle_company',
        /** Đăng ký xe mặt trước */
        'vehicle_registration_front',
        /** Đăng ký xe mặt sau */
        'vehicle_registration_back',
        /** Bằng lái xe mặt trước */
        'driver_license_front',
        /** Bằng lái xe mặt sau */
        'driver_license_back',
        /** Tên ngân hàng */
        'bank_name',
        /** Tên tài khoản ngân hàng */
        'bank_account_name',
        /** Số tài khoản ngân hàng */
        'bank_account_number',
        /** Vĩ độ hiện tại */
        'current_lat',
        /** Kinh độ hiện tại */
        'current_lng',
        /** Địa chỉ hiện tại */
        'current_address',
        /** Trạng thái hoạt động */
        'order_accepted',
    ];
    protected $casts = [
        'order_accepted' => DriverStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'driver_id');
    }

    public function scheduleOff(): HasMany
    {
        return $this->hasMany(ScheduleOff::class);
    }
    public function getNameAttribute() {
        return $this->user->fullname;
    }

    public function getPhoneAttribute() {
        return $this->user->phone;
    }

    public function scopeDriver($query)
    {
        return $query->whereHas('user.roles', function ($query) {
            $query->where('name', $this->getRoleDriver());
        });
    }
}
