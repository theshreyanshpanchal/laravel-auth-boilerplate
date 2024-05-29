<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum UserRole: string
{
    use BaseEnum;

    case ADMIN = 'admin';

    case USER = 'user';
}
