<?php

namespace App\Listeners;

use App\Enums\ActivityType;
use App\Services\ActivityManagerService;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLoggedIn
{
    public $service;

    public function __construct(ActivityManagerService $service)
    {
        $this->service = $service;
    }

    public function handle(Login $event): void
    {
        if (config('auth.track_activity')) {

            $this->service->log(ActivityType::LOGGED_IN);

        }
    }
}
