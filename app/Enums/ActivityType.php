<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum ActivityType: string
{
    use BaseEnum;

    case LOGGED_IN = 'logged-in';

    case LOGGED_OUT = 'logged-out';

    case LOCKED_OUT = 'locked-out';

    case REGISTERED = 'registered';

    case VERIFIED = 'verified';

    case PASSWORD_RESET = 'password-reset';

    public static function description(self $enum): ?string
    {
        return match ($enum) {

            self::LOGGED_IN => ':user logged into the system.',

            self::LOGGED_OUT => ':user logged out of the system.',

            self::LOCKED_OUT => ':user locked out due to multiple invalid login attempts.',

            self::REGISTERED => ':user registered in the system.',

            self::VERIFIED => ':user has verified email address.',

            self::PASSWORD_RESET => ':user has reset their password.',

            default => null,

        };
    }

}
