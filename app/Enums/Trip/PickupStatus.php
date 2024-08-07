<?php

namespace App\Enums\Trip;


use App\Admin\Support\Enum;

enum PickupStatus: int
{
    use Enum;


    // Học sinh đã bỏ qua
    case Skipped = 1;

    // Học sinh đã xin nghỉ
    case ExcusedAbsence = 2;

    // Học sinh chưa được đón đi
    case NotPickedToSchool = 3;

    // Học sinh đã được đón đi
    case PickedUpToSchool = 4;

    // Học sinh đã tới trường
    case ArrivedAtSchool = 5;

    // Học sinh chưa được đón về
    case NotPickedFromSchool = 6;

    // Học sinh đã được đón về
    case PickedUpFromSchool = 7;

    // Học sinh đã tới nhà
    case ArrivedAtHome = 8;


    public function badge(): string
    {
        return match ($this) {
            PickupStatus::NotPickedFromSchool,
            PickupStatus::NotPickedToSchool => 'bg-red',
            PickupStatus::Skipped => 'bg-yellow',
            PickupStatus::ExcusedAbsence => 'bg-blue',
            PickupStatus::ArrivedAtSchool => 'bg-orange',
            PickupStatus::ArrivedAtHome => 'bg-purple',
            PickupStatus::PickedUpToSchool,
            PickupStatus::PickedUpFromSchool => 'bg-green',
        };
    }
}
