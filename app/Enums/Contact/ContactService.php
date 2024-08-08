<?php

namespace App\Enums\Contact;


use App\Admin\Support\Enum;

enum ContactService: int
{
    use Enum;

    case Both = 1;
    case PickUpOnly = 2;
    case DropOffOnly = 3;

    public function label(): string
    {
        return match ($this) {
            ContactService::PickUpOnly => __('Chỉ đón đi'),
            ContactService::DropOffOnly => __('Chỉ đón về'),
            ContactService::Both => __('Cả hai'),
        };
    }


    public function badge(): string
    {
        return match($this) {
            ContactService::PickUpOnly => 'bg-purple-lt',
            ContactService::DropOffOnly => 'bg-indigo-lt',
            ContactService::Both => 'bg-yellow-lt',
        };
    }
}
