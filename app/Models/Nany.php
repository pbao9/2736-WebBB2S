<?php

namespace App\Models;

use App\Admin\Traits\Roles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nany extends Model
{
    use HasFactory,Roles;

    protected $table = 'nannies';

    protected $fillable = [
        /** user_id */
        'user_id',
        /** CCCD */
        'id_card',
        /** Ngày cấp CCCD */
        'id_card_date',
        /** Mặt trước CCCD */
        'id_card_front',
        /** Mặt sau CCCD */
        'id_card_back',
        /** Địa chỉ hiện tại */
        'current_address',
        /** Vĩ độ của địa chỉ hiện tại */
        'current_lat',
        /** Kinh độ của địa chỉ hiện tại */
        'current_lng',
        /** Tên ngân hàng */
        'bank_name',
        /** Tên tài khoản ngân hàng */
        'bank_account_name',
        /** Số tài khoản ngân hàng */
        'bank_account_number',
        /** Trạng thái hoạt động */
        'order_accepted',
    ];

    protected $casts = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'nany_id');
    }

    public function scheduleOff(): HasMany
    {
        return $this->hasMany(ScheduleOff::class);
    }

    public function scopeNanies($query)
    {
        return $query->whereHas('user.roles', function ($query) {
            $query->where('name', $this->getRoleNany());
        });
    }
}
