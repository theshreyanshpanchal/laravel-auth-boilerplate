<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [

            'type' => ActivityType::class,

        ];
    }

    public function user(): MorphTo
    {
        return $this->morphTo(User::class, 'model_type', 'model_id');
    }
}
