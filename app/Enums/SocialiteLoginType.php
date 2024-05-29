<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum SocialiteLoginType: string
{
    use BaseEnum;

    case GOOGLE = 'google';
    
    case FACEBOOK = 'facebook';
}
