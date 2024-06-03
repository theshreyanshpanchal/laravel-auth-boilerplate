<?php

namespace App\Models;

use App\Enums\StripeProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected function casts(): array
    {
        return [

            'type' => StripeProductType::class,

        ];
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'stripe_price', 'plan_id');
    }
}
