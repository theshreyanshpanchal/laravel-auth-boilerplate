<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class StripeService
{
    public $stripe;

    public function __construct() {

        $secret = config('services.stripe.secret');

        $this->stripe = new StripeClient($secret);

    }

    public function products(): mixed
    {
        return $this->stripe->prices->all();
    }

    public function product(string $id): mixed
    {
        return $this->stripe->products->retrieve($id);
    }

    public function currentPlan()
    {
        $user = Auth::user();

        $subscription = $user->subscriptions->first();

        return Plan::where('plan_id', $subscription->stripe_price)->first();
    }
}
