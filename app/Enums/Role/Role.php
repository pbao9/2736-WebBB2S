<?php

namespace App\Enums\Role;


use App\Admin\Support\Enum;

enum Role: string
{
    use Enum;

    case Nany = "nany";

    case Driver = "driver";
    case SupperAdmin = "superAdmin";

    case Parent = "parents";

    public function badge(): string
    {
        return match ($this) {
            Role::Parent => 'bg-green-lt',
            Role::Driver => 'bg-red-lt',
            Role::SupperAdmin => 'bg-pink-lt',
            Role::Nany => 'bg-yellow-lt'
        };
    }
}
