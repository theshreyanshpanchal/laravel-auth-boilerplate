<?php

namespace App\Listeners;

use App\Enums\ActivityType;
use App\Services\ActivityManagerService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserPasswordReset
{
    public $service;

    public function __construct(ActivityManagerService $service)
    {
        $this->service = $service;
    }

    public function handle(PasswordReset $event): void
    {
        if (config('auth.track_activity')) {

            $this->service->log(ActivityType::PASSWORD_RESET);

        }
    }
}
