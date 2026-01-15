<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'user';
    case USER = 'admin';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
