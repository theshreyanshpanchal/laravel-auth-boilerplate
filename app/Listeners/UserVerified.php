<?php

namespace App\Listeners;

use App\Enums\ActivityType;
use App\Services\ActivityManagerService;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserVerified
{
    public $service;

    public function __construct(ActivityManagerService $service)
    {
        $this->service = $service;
    }

    public function handle(Verified $event): void
    {
        if (config('auth.track_activity')) {

            $this->service->log(ActivityType::VERIFIED);

        }
    }
}
