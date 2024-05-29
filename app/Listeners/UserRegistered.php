<?php

namespace App\Listeners;

use App\Enums\ActivityType;
use App\Services\ActivityManagerService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRegistered
{
    public $service;

    public function __construct(ActivityManagerService $service)
    {
        $this->service = $service;
    }

    public function handle(Registered $event): void
    {
        if (config('auth.track_activity')) {

            $this->service->log(ActivityType::REGISTERED, $event->user);

        }
    }
}
