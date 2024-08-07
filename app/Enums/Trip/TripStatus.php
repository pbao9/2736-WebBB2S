<?php

namespace App\Enums\Trip;

use App\Admin\Support\Enum;

enum TripStatus: int
{
    use Enum;

    // Chuyến đi đã được lên kế hoạch
    case Pending = 1;

    // Chuyến đi đang diễn ra
    case Active = 2;

    // Chuyến đi đã hoàn thành
    case Completed = 3;

    // Chuyến đi đã bị hủy bỏ
    case Cancelled = 4;

    // Chuyến đi nghỉ lễ
    case Holiday = 5;

    public function badge(): string
    {
        return match ($this) {
            TripStatus::Active => 'bg-green',
            TripStatus::Pending => 'bg-yellow',
            TripStatus::Completed => 'bg-blue',
            TripStatus::Cancelled => 'bg-red',
            TripStatus::Holiday => 'bg-gold',
            default => 'bg-default',
        };
    }
}
