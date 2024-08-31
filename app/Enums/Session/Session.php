<?php

namespace App\Enums\Session;


use App\Admin\Support\Enum;

enum Session: int
{
    use Enum;

    case morning = 1;
    case afternoon = 2;

    public function label(): string
    {
        return match ($this) {
            Session::morning => __('Buổi sáng'),
            Session::afternoon => __('Buổi chiều'),
        };
    }


    public function badge(): string
    {
        return match($this) {
            Session::morning => 'bg-purple-lt',
            Session::afternoon => 'bg-indigo-lt',
        };
    }
}
