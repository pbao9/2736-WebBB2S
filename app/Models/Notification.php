<?php

namespace App\Models;

use App\Enums\Notification\NotificationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        /** parent_id */
        'parent_id',
        /** driver_id */
        'driver_id',
        /** admin_id */
        'admin_id',
        /** nany_id */
        'nany_id',
        /** Tiêu đề thông báo */
        'title',
        /** Nội dung thông báo */
        'message',
        /** Trạng thái thông báo 1: Chưa đọc, 2: Đã đọc */
        'status',
    ];

    protected $casts = [
        'status' => NotificationStatus::class,

    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenusParent::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function nany(): BelongsTo
    {
        return $this->belongsTo(Nany::class);
    }

    // Cập nhật trạng thái của thông báo
    public function markAsRead(): void
    {
        $this->status = NotificationStatus::READ;
        $this->save();
    }

    public function scopeUnread($query)
    {
        return $query->where('status', NotificationStatus::NOT_READ);
    }

}
