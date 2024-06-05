<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum TransactionType: string
{
    use BaseEnum;

    case SUBSCRIBED = 'subscribed';

    case PURCHASED = 'purchased';
}
