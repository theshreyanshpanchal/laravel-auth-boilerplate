<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum UserStatus: int
{
    use BaseEnum;

    case ACTIVE = 1;

    case DEACTIVE = 2;

    case PENDING = 3;

    case SUSPENDED = 4;
}
