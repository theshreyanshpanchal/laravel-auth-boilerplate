<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [

            'type' => TransactionType::class,

        ];
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'stripe_price', 'plan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
