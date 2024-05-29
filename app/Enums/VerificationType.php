<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum VerificationType: string
{
    use BaseEnum;

    case EMAIL_VERIFICATION = 'email-verification';

    case PHONE_NUMBER_VERIFICATION = 'phone-number-verification';
}
