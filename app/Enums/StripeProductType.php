<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum StripeProductType: string
{
    use BaseEnum;

    case RECURRING = 'recurring';

    case ONE_TIME = 'one_time';
}
