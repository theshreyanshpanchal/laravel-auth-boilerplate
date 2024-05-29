<?php

namespace App\Listeners;

use App\Enums\ActivityType;
use App\Models\User;
use App\Services\ActivityManagerService;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLockedOut
{
    public $service;

    public function __construct(ActivityManagerService $service)
    {
        $this->service = $service;
    }

    public function handle(Lockout $event): void
    {
        if (config('auth.track_activity')) {

            $request = $event->request;

            $email = $request->input('email');

            $user = User::where('email', $email)->first();

            $this->service->log(ActivityType::LOCKED_OUT, $user);

        }
    }
}
