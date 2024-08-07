<?php

namespace App\Admin\Traits;

use App\Enums\Role\Role;

trait Roles
{
    public function getRoleNany(): string
    {
        return Role::Nany->value;
    }

    public function getRoleSupperAdmin(): string
    {
        return Role::Driver->value;
    }

    public function getRoleDriver(): string
    {
        return Role::Driver->value;
    }


    public function getRoleParent(): string
    {
        return Role::Parent->value;
    }




}
