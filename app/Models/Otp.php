<?php

namespace App\Models;

use App\Enums\VerificationType;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [

            'type' => VerificationType::class,

        ];
    }
}
