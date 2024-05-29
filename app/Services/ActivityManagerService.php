<?php

namespace App\Services;

use App\Enums\ActivityType;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivityManagerService
{
    public function log(ActivityType $type, ?User $user = null): void
    {
        $user = $user ? $user : Auth::user();

        Activity::create([

            'model_type' => get_class($user),

            'model_id' => $user->id,

            'type' => $type,

            'description' => ActivityType::description($type)

        ]);
    }
}
