<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\Subscription as Model;

class Subscription extends Model
{
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'stripe_price', 'plan_id');
    }
}
